<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;
use Yiisoft\Router\UrlGeneratorInterface;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var UrlGeneratorInterface $urlGenerator
 */

$this->setTitle($applicationParams->name);
?>

<div class="text-center">
    <h1>Hello!</h1>

    <p>Let's start something great with <strong>Yii3</strong>!</p>

    <p>
        <a href="https://yiisoft.github.io/docs/" target="_blank" rel="noopener">
            <i>Don't forget to check the guide.</i>
        </a>
    </p>

    <p>Example of a protected page: <a href="<?= $urlGenerator->generate('user-info') ?>">User info</a></p>
</div>
