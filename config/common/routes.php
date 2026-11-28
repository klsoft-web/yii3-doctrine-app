<?php

declare(strict_types=1);

use App\Presentation;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create()
        ->routes(
            Route::get('/')
                ->action(Presentation\HomePage\Action::class)
                ->name('home'),
            Route::methods(['GET', 'POST'], '/login')
                ->action([Presentation\Auth\AuthController::class, 'login'])
                ->name('login'),
            Route::methods(['GET', 'POST'], '/register')
                ->action([Presentation\Auth\AuthController::class, 'register'])
                ->name('register'),
            Route::post('/logout')
                ->action([Presentation\Auth\AuthController::class, 'logout'])
                ->name('logout'),
            Route::get('/user-info')
                ->middleware(Authentication::class)
                ->action([Presentation\User\UserController::class, 'info'])
                ->name('user-info'),
        ),
];
