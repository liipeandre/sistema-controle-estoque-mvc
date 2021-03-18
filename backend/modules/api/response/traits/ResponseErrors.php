<?php


class ResponseErrors {
    private $errorsList = [
        "SUCCESS" => [0, "Action executed successful."],
        "INVALID_REQUEST" => [1, "Required request parameters 'Table', 'Action' or 'Data' is invalid or missing."],
        "INVALID_REQUEST_DATA" => [2, "Required 'Data' request parameters is invalid or missing."],
        "SERVER_READY" => [3, "Server ready to receive requests."],
        "INVALID_LOGIN" => [4, "Invalid login. Please verify and try again."],
        "INVALID_PASSWORD" => [5, "Invalid password. Please verify and try again."],
        "NOT_AUTHENTICATED" => [6, "Not authenticated. Please authenticate using your login and password."],
    ];


    public function getResponseError($name){
        if(isset($name) && array_key_exists($name, $this->errorsList)){
            return [
                'code' => $this->errorsList[$name][0],
                'message' => $this->errorsList[$name][1],
            ];
        }
        else{
            return [
                'code' => $this->errorsList['SUCCESS'][0],
                'message' => $this->errorsList['SUCCESS'][1],
            ];
        }
    }
}