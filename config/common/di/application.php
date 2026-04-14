<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Yiisoft\Definitions\Reference;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\Translator\SimpleMessageFormatter;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;

/** @var array $params */

return [
    ApplicationParams::class => [
        '__construct()' => [
            'name' => $params['application']['name'],
            'charset' => $params['application']['charset'],
            'locale' => $params['application']['locale'],
        ],
    ],

    CacheItemPoolInterface::class => ArrayAdapter::class, //One of the following adapters should be used instead: Psr16Adapter, RedisAdapter, MemcachedAdapter, DoctrineDbalAdapter, and so forth.
    Configuration::class => static function (ContainerInterface $container) use ($params) {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: $params['doctrine']['paths'],
            isDevMode: $params['doctrine']['isDevMode'],
            cache: $container->get(CacheItemPoolInterface::class));
        $config->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_FILE_NOT_EXISTS_OR_CHANGED);
        return $config;
    },
    EntityManagerInterface::class => static function (ContainerInterface $container) use ($params) {
        $configuration = $container->get(Configuration::class);
        return new EntityManager(
            DriverManager::getConnection(
                $params['doctrine']['connection'],
                $configuration
            ),
            $configuration);
    },
    EntityManagerProvider::class => SingleManagerProvider::class,

    TranslatorInterface::class => [
        'class' => Translator::class,
        '__construct()' => [
            $params['application']['locale'],
            $params['yiisoft/translator']['fallbackLocale'],
            $params['yiisoft/translator']['defaultCategory'],
            Reference::optional(EventDispatcherInterface::class),
            new SimpleMessageFormatter()
        ],
        'addCategorySources()' => ['categories' => [
            new CategorySource($params['yiisoft/translator']['defaultCategory'], new MessageSource($params['messagesPath']))
        ]],
    ],
];
