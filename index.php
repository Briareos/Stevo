<?php

// Set the application environment.
$env = 'dev';
if (getenv('APP_ENV') === 'prod') {
    $env = 'prod';
}
define('APP_ENV', $env);
unset($env);

ini_set("error_log", APP_ENV . ".log");
if (APP_ENV === 'prod') {
    ini_set("display_errors", 0);
}

// Register the autoloader.
spl_autoload_register(function ($class) {
    switch ($class) {
        case "Company";
            require "lib/model/company.php";
            return;
        case "Project":
            require "lib/model/project.php";
            return;
        case "Employee":
            require "lib/model/employee.php";
            return;
        case "Template":
            require "lib/template.php";
            return;
        case "DB":
            require "lib/db.php";
            DB::register('stevo', 'stevo', 'stevo');
            return;
        case "FlashMessage":
            ensure_session_started();
            require "lib/flash-message.php";
            return;
        case "HttpException":
            require "lib/http-exception.php";
            return;
    }
});

// Check if we have the database ready.
if (APP_ENV === "dev") {
    check_config();
}

function get_page()
{
    $page = "";
    if (isset($_GET["p"])) {
        $page = $_GET["p"];
    }

    switch ($page) {
        case "":
            return "home";
        case "company-new":
            return "company/new";
        case "company-view":
            return "company/view";
        case "company-list":
            return "company/list";
        case "company-delete":
            return "company/delete";
        case "company-edit":
            return "company/edit";
        case "admin":
            return "admin";
        default:
            return "error/404";
    }
}

function check_config()
{
    if (file_exists("config.php")) {
        return;
    }
    $error = null;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
            $db = new DB($_POST["database_name"], $_POST["database_user"], $_POST["database_password"]);
            $db->exec(file_get_contents("schema.sql"));
            $config = "<?php return " . var_export($_POST, true) . ";";
            $saved = file_put_contents("config.php", $config);
            if (!$saved) {
                throw new Exception("Could not write application configuration to file <code>config.php</code>");
            }
            // Refresh the page so the configuration can be loaded.
            echo '<meta http-equiv="refresh" content="0">';
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    ?>
    <div class="container">
        <?php if ($error): ?>
            <p><strong>Error:</strong> <?= $error ?></p>
        <?php endif ?>
        <p>Please provide the application configuration:</p>
        <style>
            input, label {
                display: block;
            }
        </style>
        <form method="post">
            <label for="database_name">Database name</label>
            <input id="database_name" name="database_name" autofocus>
            <label for="database_user">Database user</label>
            <input id="database_user" name="database_user">
            <label for="database_password">Database password</label>
            <input id="database_password" name="database_password">
            <button type="submit">Save configuration</button>
        </form>
    </div>
    <?php
    exit;
}

function main()
{
    require "lib/functions.php";

    $page = get_page();

    try {
        require "page/$page.php";
    } catch (HttpException $e) {
        require sprintf("page/error/%s.php", $e->getCode());
    } catch (Exception $e) {
        require "page/error/500.php";
    }
}

main();
