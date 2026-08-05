<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;
use Yiisoft\Yii\View\Renderer\Csrf;
use Yiisoft\Html\Html;
use App\Data\Entities\User;
use Yiisoft\Router\UrlGeneratorInterface;

/**
 * @var WebView $this
 * @var Csrf $csrf
 * @var ApplicationParams $applicationParams
 * @var User $user
 * @var UrlGeneratorInterface $urlGenerator
 */

$this->setTitle('User info');
?>

<div class="container text-center col-4">
    <h1>User info</h1>

    <p><span class="fw-bold">Name:</span> <?= $user->getName() ?></p>

    <p><span class="fw-bold">Email:</span> <?= $user->getEmail() ?></p>

    <?= Html::form()
        ->post($urlGenerator->generate('logout'))
        ->csrf($csrf)
        ->open() ?>
    <button class="btn btn-primary w-100" type="submit">Sign out</button>
    <?= '</form>' ?>
</div>
