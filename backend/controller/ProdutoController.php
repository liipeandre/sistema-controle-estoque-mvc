<?php

require_once __DIR__ . "/../modules/base/BaseController.php";


class ProdutoController extends BaseController {
    public function insert(Request $request){
        $fieldRules = [
            "nome" => ["required", "max:45", "type:text"],
            "quantidade" => ["required", "type:integer", "min:0"],
            "categoria" => ["required", "type:text"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function delete(Request $request){
        $fieldRules = [
            "idproduto" => ["required", "type:integer", "min:0"]
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function list(Request $request){
        $response = $request->validateRequestData([]);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }

        return $response;
    }


    public function view(Request $request){
        $fieldRules = [
            "idproduto" => ["required", "type:integer", "min:0"]
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }

        return $response;
    }


    public function edit(Request $request){
        $fieldRules = [
            "nome" => ["required", "max:45", "type:text"],
            "quantidade" => ["required", "type:integer", "min:0"],
            "categoria" => ["required", "type:text"],
            "idproduto" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }
}