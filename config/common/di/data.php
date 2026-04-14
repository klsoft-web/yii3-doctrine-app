<?php

declare(strict_types=1);

use App\Data\Auth\AuthKeyRepository;
use App\Data\Auth\AuthKeyRepositoryInterface;
use App\Data\Auth\AuthRepositoryInterface;
use App\Data\Auth\AuthRepository;
use App\Data\Auth\IdentityRepository;
use App\Data\User\UserRepositoryInterface;
use App\Data\User\UserRepository;
use Yiisoft\Auth\IdentityRepositoryInterface;

/** @var array $params */

return [
    UserRepositoryInterface::class => UserRepository::class,
    AuthRepositoryInterface::class => [
        'class' => AuthRepository::class,
        '__construct()' => [
            'minPasswordLength' => $params['auth']['minPasswordLength'],
            'redirectQueryParameterName' => $params['yiisoft/user']['redirectQueryParameterName']
        ]
    ],
    AuthKeyRepositoryInterface::class => [
        'class' => AuthKeyRepository::class,
        '__construct()' => [
            'duration' => $params['yiisoft/user']['cookieLogin']['duration'] !== null ?
                new DateInterval($params['yiisoft/user']['cookieLogin']['duration']) :
                null
        ]
    ],
    IdentityRepositoryInterface::class => IdentityRepository::class,
];
