<?php

$company = DB::getInstance()->findCompany((int)@$_GET["id"]);
if ($company === null) {
    throw new HttpException("Company not found", 404);
}

$tpl = new Template();
$tpl->title = "Edit company {$company->name}";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $tpl->content = function () use ($company) {
        ?>
        <ul class="breadcrumb">
            <li><a href="?p=company-list">Companies</a></li>
            <li><a href="?p=company-view&id=<?= $company->id ?>"><?= e($company->name) ?></a></li>
            <li>Edit</li>
        </ul>
        <?php
        require "_form.php";
    };
    $tpl->render(__DIR__ . "/../_layout.php");
} else {
    DB::getInstance()->saveCompany($company);
    FlashMessage::set("success", "Company updated.");
    header("Location: ?p=company-view&id=" . $company->id);
}
