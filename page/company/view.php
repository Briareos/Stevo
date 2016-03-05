<?php

$company = DB::getInstance()->findCompany((int)@$_GET["id"]);
if ($company === null) {
    throw new HttpException("Company not found", 404);
}

$tpl = new Template();
$tpl->title = "Company {$company->name}";
$tpl->content = function () use ($company) {
    ?>
    <ul class="breadcrumb">
        <li><a href="?p=company-list">Companies</a></li>
        <li><?= e($company->name) ?></li>
    </ul>
    <div>
        <h1><?= e($company->name) ?></h1>
        <p>Company details</p>
    </div>
    <hr>
    <a href="?p=company-edit&id=<?= $company->id ?>" class="btn btn-default">Edit</a>
    <a href="?p=company-delete&id=<?= $company->id ?>" class="btn btn-danger">Delete</a>
    <?php
};
$tpl->render(__DIR__ . "/../_layout.php");

