<?php

require_once __DIR__ . "/../modules/base/BaseController.php";


class UsuarioController extends BaseController {
    public function login(Request $request){
        $fieldRules = [
            "login" => ["required", "max:45", "type:text"],
            "senha" => ["required", "max:255", "type:text"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){

            $response = $this->redirect($request, $this->model);
            $response = $this->auth->login($request, $response, 'senha');

            if($response->isSuccess()){
                header('Location: /public/main.php');
                exit;
            }
        }
        return $response;
    }


    public function logout(Request $request){
        $response = $this->auth->logout();
        if($response->isSuccess()){
            header('Location: /public/index.php');
            exit;
        }
    }
}