<?php

$companies = DB::getInstance()->getCompanies();

$tpl = new Template();
$tpl->title = "Listing companies";
$tpl->active = "company-list";
$tpl->content = function () use ($companies) {
    ?>
    <ul class="breadcrumb">
        <li>Companies</li>
    </ul>
    <table class="table table-striped">
        <tr>
            <th>Company</th>
            <th style="text-align: right">Actions</th>
        </tr>
        <?php if ($companies): ?>
            <?php foreach ($companies as $company): ?>
                <tr>
                    <td>
                        <a href="?p=company-view&id=<?= $company->id ?>">
                            <?= e($company->name) ?>
                        </a>
                    </td>
                    <td align="right">
                        <a class="btn btn-default" href="?p=company-edit&id=<?= $company->id ?>">Edit</a>
                        <a class="btn btn-danger" href="?p=company-delete&id=<?= $company->id ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="2"><em>No companies registered</em></td>
            </tr>
        <?php endif ?>
    </table>
    <hr>
    <a href="?p=company-new" class="btn btn-primary">Create a new company</a>
    <?php
};
$tpl->render(__DIR__ . "/../_layout.php");
