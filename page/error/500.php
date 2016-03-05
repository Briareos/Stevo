<?php

/** @var Exception $e */
$tpl = new Template();
$tpl->body = function () use ($e) {
    ?>
    <div class="container">
        <h1>500 - Internal Server Error</h1>

        <p><?= e($e->getMessage()) ?></p>
        <code><?= e($e->getTraceAsString()) ?></code>
    </div>
    <?php
};
$tpl->render(__DIR__ . "/../_layout.php");
