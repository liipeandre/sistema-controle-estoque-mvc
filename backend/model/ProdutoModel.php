<?php

require_once __DIR__ . "/../modules/base/BaseModel.php";


class ProdutoModel extends BaseModel {
    public function insert(Request $request){
        $statement = "
            insert into produtos (nome, quantidade, categoria)
            values (:nome, :quantidade, :categoria)
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function delete(Request $request){
        $statement = "
            delete from produtos where idproduto = :idproduto
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if($response->isSuccess()){
            $response = $this->list($request);
        }
        return $response;
    }


    public function list(Request $request){
        $statement = "
            select idproduto, nome, quantidade, categoria from produtos
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function view(Request $request){
        $statement = "
            select idproduto, nome, quantidade, categoria from produtos where idproduto = :idproduto
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function edit(Request $request){
        $statement = "
            update produtos set nome = :nome, quantidade = :quantidade, categoria = :categoria
            where idproduto = :idproduto;
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if($response->isSuccess()){
            $response = $this->view($request);
        }
        return $response;
    }
}