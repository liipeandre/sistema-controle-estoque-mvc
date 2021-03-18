<?php

require_once __DIR__ . "/../modules/base/BaseModel.php";


class UsuarioModel extends BaseModel {
    public function login(Request $request){
        $statement = "
            select senha from usuarios where login = :login
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }
}