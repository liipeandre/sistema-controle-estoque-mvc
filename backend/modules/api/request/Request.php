<?php

require_once "traits/RequestValidation.php";
require_once "traits/RequestFormat.php";
require_once "traits/RequestDataValidation.php";
require_once "traits/RequestDataTypeValidation.php";


class Request {
    use RequestValidation;
    use RequestFormat;
    use RequestDataValidation;
    use RequestDataTypeValidation;

    protected $name;
    protected $action;
    protected $requireAuth;
    protected $data;


    public function __construct($requestType, $requireAuth = false) {
        if($requestType == "async"){
            $this->getAsyncRequest();
        }
        else{
            $this->getSyncRequest();
        }
        $this->requireAuth = $requireAuth;
    }


    private function getSyncRequest(){
        $this->name = isset($_GET["name"]) ? $_GET["name"] : "";
        $this->action = isset($_GET["action"]) ? $_GET["action"] : "";
        $this->data = isset($_POST) ? $_POST : [];
    }


    private function getAsyncRequest(){
        $request = json_decode(file_get_contents('php://input'), true);

        $this->name = isset($request["name"]) ? $request["name"] : "";
        $this->action = isset($request["action"]) ? $request["action"] : "";
        $this->data = isset($request["data"]) ? $request["data"] : [];
    }


    public function getName() {
        return $this->name;
    }


    public function getAction() {
        return $this->action;
    }


    public function getData($field = null) {
        $output = null;
        if(isset($this->data[$field])){
            $output = $this->data[$field];
        }
        else{
            $output = $this->data;
        }
        return $output;
    }


    public function setData($field, $data) {
        $this->data[$field] = $data;
    }
}