<?php

declare(strict_types=1);

use Yiisoft\Yii\Auth\Session\Login\Cookie\ForceAddCookiePolicy;

return [
    'yiisoft/yii-auth-session' => [
        'cookieLogin' => [
            'forceAddCookiePolicy' => ForceAddCookiePolicy::AfterLogin,
            'encryptorKey' => '', // secret key to encrypt the auto-login cookie value, set it to `null` to store it unencrypted
            'signerKey' => null, // secret key to sign the auto-login cookie value, set it to `null` to store it unsigned
        ],
    ],
];
