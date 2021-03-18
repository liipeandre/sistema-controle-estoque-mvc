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
                        <h1 class="h2">Produtos em Estoque</h1>
                    </div>
                    <?php
                    if($response->getCode() != 6 && (!isset($_GET["action"]) || ($_GET["action"] != 'view' && $_GET["action"] != 'list'))){
                        echo "
                                    <div class=\"alert alert-warning\" role=\"alert\">
                                        {$response->getMessage()}
                                    </div>
                                ";
                    }
                    ?>
                    <div class="table-responsive">
                        <a href="/public/produtos/insert.php" class="btn btn-dark">Adicionar Novo Produto</a>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Categoria</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($response->getData('', true) as $registry){
                                        echo '<tr>';
                                        echo '<td>' . $registry['nome'] . '</td>';
                                        echo '<td>' . $registry['quantidade'] . '</td>';
                                        echo '<td>' . $registry['categoria'] . '</td>';
                                        echo '<td>
                                                <form method="post" action="/public/produtos/edit.php?name=produto&action=view">
                                                   <input type="hidden" name="idproduto" value="' . $registry["idproduto"] . '"></input>
                                                   <button type="submit"><i class="fa fa-edit"></i></button>
                                                </form>
                                              </td>';
                                        echo '<td>
                                                <form method="post" action="/public/produtos/list.php?name=produto&action=delete">
                                                   <input type="hidden" name="idproduto" value="' . $registry["idproduto"] . '"></input>
                                                   <button type="submit"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                              </td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/public/assets/templates/js.php"; ?>

    </body>
</html>
