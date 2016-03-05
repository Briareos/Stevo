<?php

$company = DB::getInstance()->findCompany((int)@$_GET["id"]);
if ($company === null) {
    throw new HttpException("Company not found", 404);
}

DB::getInstance()->deleteCompany($company);

FlashMessage::set("success", sprintf("Company <em>%s</em> deleted.", e($company->name)));
header("Location: ?p=company-list");

