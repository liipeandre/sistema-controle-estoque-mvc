<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true);
$response = $api->process($request);

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema - Produtos</title>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/css.php"; ?>

    </head>
    <body>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/header.php"; ?>

        <div class="container-fluid">
            <div class="row">

                <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/sidebar.php"; ?>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Adicionar Novo Produto</h1>
                    </div>

                    <form action="?name=produto&action=insert" method="post">
                        <?php
                            if($response->getCode() != 6){
                                echo "
                                    <div class=\"alert alert-warning\" role=\"alert\">
                                        {$response->getMessage()}
                                    </div>
                                ";
                            }
                        ?>


                        <label for="nome" class="visually-hidden">Nome:</label>
                        <input type="text" name=nome id="nome" class="form-control" placeholder="Nome do Produto" required autofocus>

                        <label for="quantidade" class="visually-hidden">Quantidade:</label>
                        <input type="number" name=quantidade id="quantidade" class="form-control" placeholder="Quantidade" required>

                        <label for="categoria" class="visually-hidden">Categoria</label>
                        <select class="form-select" name="categoria" id="categoria">
                            <option value="Placeholder" selected disabled>Selecione uma categoria</option>
                            <option value="Informática">Informática</option>
                            <option value="Telefonia">Telefonia</option>
                            <option value="Moda">Moda</option>
                            <option value="Eletrodomésticos">Eletrodomésticos</option>
                            <option value="Automotivo">Automotivo</option>
                            <option value="Meias">Pet Shop</option>
                        </select>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Adicionar</button>
                    </form>
                </main>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/js.php"; ?>

    </body>
</html>
