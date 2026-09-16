<?php

declare(strict_types=1);

use App\Web\Auth\AuthenticationFailureWithRedirectToLoginUrl;
use App\Web\NotFound\NotFoundHandler;
use App\Web\Auth\CookieLogin;
use Yiisoft\Auth\AuthenticatorInterface;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Csrf\CsrfTokenMiddleware;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Input\Http\HydratorAttributeParametersResolver;
use Yiisoft\Input\Http\RequestInputParametersResolver;
use Yiisoft\Middleware\Dispatcher\CompositeParametersResolver;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Middleware\Dispatcher\ParametersResolverInterface;
use Yiisoft\RequestProvider\RequestCatcherMiddleware;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionInterface;
use Yiisoft\Session\SessionMiddleware;
use Yiisoft\User\CurrentUser;
use Yiisoft\User\Login\Cookie\CookieLoginMiddleware;
use Yiisoft\User\Method\ApiAuth;
use Yiisoft\Yii\Http\Application;

/** @var array $params */

return [
    Application::class => [
        '__construct()' => [
            'dispatcher' => DynamicReference::to([
                'class' => MiddlewareDispatcher::class,
                'withMiddlewares()' => [
                    [
                        ErrorCatcher::class,
                        SessionMiddleware::class,
                        CookieLoginMiddleware::class,
                        CsrfTokenMiddleware::class,
                        RequestCatcherMiddleware::class,
                        Router::class,
                    ],
                ],
            ]),
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],

    ParametersResolverInterface::class => [
        'class' => CompositeParametersResolver::class,
        '__construct()' => [
            Reference::to(HydratorAttributeParametersResolver::class),
            Reference::to(RequestInputParametersResolver::class),
        ],
    ],

    AuthenticatorInterface::class => ApiAuth::class,

    Authentication::class => [
        '__construct()' => [
            'authenticationFailureHandler' => Reference::to(AuthenticationFailureWithRedirectToLoginUrl::class),
        ],
    ],

    CurrentUser::class => [
        'withSession()' => [Reference::to(SessionInterface::class)],
        'reset' => function () {
            $this->clear();
        },
    ],

    CookieLogin::class => [
        '__construct()' => [
            'duration' => $params['yiisoft/user']['cookieLogin']['duration'] !== null ?
                new DateInterval($params['yiisoft/user']['cookieLogin']['duration']) :
                null,
        ],
        'withCookieSecure()' => [false]
    ],
];
