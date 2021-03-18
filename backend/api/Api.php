<?php

require_once __DIR__ . "/../modules/api/request/Request.php";
require_once __DIR__ . "/../modules/api/response/Response.php";

require_once __DIR__ . "/../modules/base/BaseComponent.php";


class Api extends BaseComponent {
    private $controller;

    public function __construct() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }


    public function process(Request $request){
        $response = new Response();
        try{
            if($request->emptyRequest() || !$request->isValidAuth()){
                $response->setResponseContent('NOT_AUTHENTICATED');
                if(!$request->isValidAuth()){
                    header('Location: /public/index.php');
                    exit;
                }
            }
            elseif($request->validRequest()){
                $this->controller = $this->getComponent($request->toPascalCase('name'), "Controller");
                $response = $this->redirect($request, $this->controller);
            }
            else{
                $response->setResponseContent('INVALID_REQUEST');
            }
        }
        catch (Exception $exception){
            $response->setException($exception);
        }
        return $response;
    }
}