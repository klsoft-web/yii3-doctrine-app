<?php

declare(strict_types=1);

use App\Domain\Auth\AuthManager;
use App\Domain\Auth\AuthManagerInterface;

return [
    AuthManagerInterface::class => AuthManager::class,
];
