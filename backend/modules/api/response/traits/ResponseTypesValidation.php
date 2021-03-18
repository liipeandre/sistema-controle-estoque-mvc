<?php


trait ResponseTypesValidation {
    protected function isDatabaseException($exception){
        return preg_match('/SQLSTATE\[/', $exception->getMessage());
    }


    protected function isExecutionDatabaseException($exception){
        return isset($exception->errorInfo[2]);
    }
}