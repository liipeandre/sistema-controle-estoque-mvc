<?php

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync', true);

if($request->isValidAuth()){
    header('Location: /public/main.php');
}

$request = new Request('sync');
$response = $api->process($request);

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema - Login</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/signin.css" rel="stylesheet">

    </head>
    <body class="text-center">
        <main class="form-signin">
            <form action="?name=usuario&action=login" method="post">
                <img class="mb-4" src="assets/logo/bootstrap-logo.svg" alt="" width="72" height="57">
                <?php
                if($response->getCode() != 6){
                    echo "
                        <div class=\"alert alert-warning\" role=\"alert\">
                            {$response->getMessage()}
                        </div>
                    ";
                }
                ?>
                <label for="login" class="visually-hidden">Login</label>
                <input type="text" name=login id="login" class="form-control" placeholder="Login" required autofocus>

                <label for="senha" class="visually-hidden">Senha</label>
                <input type="password" name=senha id="senha" class="form-control" placeholder="Senha" required>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                <p class="mt-5 mb-3 text-muted">&copy;André Felipe 2021-</p>
            </form>
        </main>
    </body>
</html>
