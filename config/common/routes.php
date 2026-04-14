<?php

declare(strict_types=1);

use App\Web;
use Klsoft\Yii3Auth\Middleware\Authentication;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create()
        ->routes(
            Route::get('/')
                ->action(Web\HomePage\Action::class)
                ->name('home'),
            Route::methods(['GET', 'POST'], '/login')
                ->action([Web\Auth\AuthController::class, 'login'])
                ->name('login'),
            Route::methods(['GET', 'POST'], '/register')
                ->action([Web\Auth\AuthController::class, 'register'])
                ->name('register'),
            Route::post('/logout')
                ->action([Web\Auth\AuthController::class, 'logout'])
                ->name('logout'),
            Route::get('/user-info')
                ->middleware(Authentication::class)
                ->action([Web\User\UserController::class, 'info'])
                ->name('user-info'),
        ),
];
