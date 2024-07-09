<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$nav_items = [
    '/admin/currency/index' => 'Currencies',
    '/admin/product/index' => 'Products',
    '/admin/purchase/index' => 'Purchases',
]
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css"/>
</head>
<body>
<?php $this->beginBody() ?>
<header class="container">
    <nav>
        <ul>
            <li><a class="contrast" href="/admin"><strong>Admin Panel</strong></a></li>
        </ul>
        <ul>
            <?php foreach ($nav_items as $url => $label): ?>
                <li><a class="contrast" href="<?= $url ?>"><?= $label ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
<main class="container">
    <?= $content ?>
</main>
<footer></footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
