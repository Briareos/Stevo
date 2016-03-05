<?php

$page = "company-new";
$companyName = "";
if (isset($company)) {
    $page = "company-edit";
    $companyName = $company->name;
}
?>
<form action="?p=<?= $page ?>" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Company Name"
               value="<?= e($companyName) ?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
