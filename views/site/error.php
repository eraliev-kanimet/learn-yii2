<?php

/* @var $this yii\web\View */
/* @var $exception yii\web\HttpException */

$this->title = $exception->statusCode . ' - ' . $exception->getMessage();
?>

<div class="site-error">

    <h1><?= $this->title ?></h1>

    <div class="alert alert-danger">
        <?= nl2br($exception->getMessage()) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
