<?php

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync', true);
$response = $api->process($request);

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema - Home</title>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/css.php"; ?>

    </head>
    <body>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/header.php"; ?>

        <div class="container-fluid">
            <div class="row">

                <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/sidebar.php"; ?>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                </main>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/js.php"; ?>

    </body>
</html>
