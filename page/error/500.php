<?php

/** @var Exception $e */
$tpl = new Template();
$tpl->body = function () use ($e) {
    ?>
    <div class="container">
        <h1>500 - Internal Server Error</h1>

        <p>
            <code><?= e($e->getMessage()) ?></code>
        </p>
        
        <pre><?= e($e->getTraceAsString()) ?></pre>
    </div>
    <?php
};
$tpl->render(__DIR__ . "/../_layout.php");
