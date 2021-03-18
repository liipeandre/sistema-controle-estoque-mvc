<?php

require_once __DIR__ . "/../api/response/Response.php";


class DatabaseHandler {
    // TODO: configure according to the project
    private $database = 'mysql';
    private $databaseName = 'sistemacontroleestoque';
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';


    private static $connection;


    public function __construct() {
        try {
            self::$connection = new PDO(
                $this->database . ":host={$this->host};dbname=" . $this->databaseName, $this->user, $this->password
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){
            $response = new Response();
            $response->setException($exception);

            throw $response;
        }
    }


    public function beginTransaction(){
        if(!self::$connection->inTransaction()){
            self::$connection->beginTransaction();
        }
    }


    public function commit(){
        if(self::$connection->inTransaction()){
            self::$connection->commit();
        }
    }


    public function rollback(){
        if(self::$connection->inTransaction()){
            self::$connection->rollBack();
        }
    }


    private function getQueryParameters($statement, $parameters){
        preg_match_all('/:[A-Za-z0-9_]+/', $statement, $matches);
        foreach ($parameters as $index => $value){
            if(in_array(":$index", $matches[0])) {
                $parameters[":$index"] = $value;
            }
            unset($parameters[$index]);
        }
        return $parameters;
    }


    public function executeQuery($statement, $parameters = []){
        try {
            $query = self::$connection->prepare($statement);
            $parameters = $this->getQueryParameters($statement, $parameters);
            $query->execute($parameters);

            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            $response = new Response();
            $response->setResponseContent('SUCCESS', null, $data);

            return $response;
        }
        catch(PDOException $exception){
            $this->rollback();

            $response = new Response();
            $response->setException($exception);

            return $response;
        }
    }
}