<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error 500</title>
</head>
<body>
<h1>Error 500</h1>
<?php if (APP_ENV === "dev"): ?>
    <hr>
    <p><?= e($e->getMessage()) ?></p>
    <code><?= e($e->getTraceAsString()) ?></code>
<?php endif ?>
</body>
</html>
