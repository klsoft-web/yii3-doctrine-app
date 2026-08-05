<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use App\Web\Shared\Layout\Main\MainAsset;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Html\Html;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Aliases $aliases
 * @var AssetManager $assetManager
 * @var string $content
 * @var CurrentRoute $currentRoute
 * @var UrlGeneratorInterface $urlGenerator
 */

$assetManager->register(MainAsset::class);

$this->addCssFiles($assetManager->getCssFiles());
$this->addCssStrings($assetManager->getCssStrings());
$this->addJsFiles($assetManager->getJsFiles());
$this->addJsStrings($assetManager->getJsStrings());
$this->addJsVars($assetManager->getJsVars());

$this->beginPage()
?>
<!DOCTYPE html>
<html class="h-100" lang="<?= Html::encode($applicationParams->locale) ?>">
<head>
    <meta charset="<?= Html::encode($applicationParams->charset) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= $aliases->get('@baseUrl/favicon.svg') ?>" type="image/svg+xml">
    <title><?= Html::encode($this->getTitle()) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <nav class="navbar navbar-expand-md navbar-dark navbar-bg mb-4">
        <div class="container">
            <a href="/" class="navbar-brand">My Project</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <?= Html::a('User info', $urlGenerator->generate('user-info'), ['class' => 'nav-link' . ($currentRoute->getName() === 'user-info' ? ' active' : '')]) ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <?= $content ?>
</main>

<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
        <span class="text-body-secondary">Place sticky footer content here</span>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
