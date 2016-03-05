<?php

$template = new Template();
$template->title = "Homepage";
$template->active = "home";
$template->content = function () {
    ?>
    Homepage
    <?php
};

$template->render(__DIR__ . "/_layout.php");
