<?php

$tpl = new Template();
$tpl->title = "Create a new company";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $tpl->content = function () {
        ?>
        <ul class="breadcrumb">
            <li><a href="?p=company-list">Companies</a></li>
            <li>Create</li>
        </ul>
        <?php
        require "_form.php";
    };
    $tpl->render(__DIR__ . "/../_layout.php");
} else {
    $company = new Company($_POST["name"]);
    DB::getInstance()->saveCompany($company);
    FlashMessage::set("success", "Company created.");
    header("Location: ?p=company-view&id=" . $company->id);
}

