<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= e($title) ?></title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        .main.container {
            margin-top: 60px;
        }
    </style>
    <script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php if ($body): $body(); else: ?>
    <?php require "_navigation.php" ?>


    <div class="main container">
        <?php require "_flash.php" ?>
        <?php if ($content) $content() ?>
    </div>
<?php endif ?>
</body>
</html>
