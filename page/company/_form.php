<?php

$action = "?p=company-new";
$companyName = "";
if (isset($company)) {
    $action = "?p=company-edit&id={$company->id}";
    $companyName = $company->name;
}
?>
<form action="<?= $action ?>" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Company Name"
               value="<?= e($companyName) ?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
