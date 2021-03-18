<?php


class Auth {
    public function login(Request $request, Response $response, $passwordField){
        $newResponse = new Response();

        $passwordFromForm = $request->getData($passwordField);
        $passwordFromDatabase = $response->getData($passwordField);

        if($response->isEmpty()){
            $newResponse->setResponseContent('INVALID_LOGIN');
        }
        elseif(password_verify($passwordFromForm, $passwordFromDatabase)){
            $_SESSION["logged"] = true;
            $newResponse->setResponseContent('SUCCESS');
        }
        else{
            $newResponse->setResponseContent('INVALID_PASSWORD');
        }
        return $newResponse;
    }


    public function logout(){
        $response = new Response();

        $_SESSION["logged"] = false;
        $response->setResponseContent('SUCCESS');

        return $response;
    }
}