<?php

$tpl = new Template();
$tpl->body = function () {
    ?>
    <div class="container">
        <h1>404 - Page not found</h1>
    </div>
    <?php
};
$tpl->render(__DIR__ . "/../_layout.php");
