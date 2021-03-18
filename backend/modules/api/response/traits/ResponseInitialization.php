<?php


trait ResponseInitialization {
    public function setException($exception){
        if($this->isDatabaseException($exception)) {
            $this->setDatabaseExceptionContent($exception);
        }
        elseif($this->isExecutionDatabaseException($exception)){
            $this->setExecutionDatabaseExceptionContent($exception);
        }
        else{
            $this->setExceptionContent($exception);
        }
    }


    private function setDatabaseExceptionContent($exception){
        preg_match('/SQLSTATE\[(\w+)]:{0,1} (?:\[(\w+)] ){0,1}(.*)/', $exception->getMessage(), $matches);
        $this->code = $matches[1] == 'HT000' ? $matches[2] : $matches[1];
        $this->message = $matches[3];
    }


    private function setExecutionDatabaseExceptionContent($exception){
        $this->message = $exception->errorInfo[2];
        $this->code = $exception->getCode();
    }


    private function setExceptionContent($exception){
        $this->message = $exception->getMessage();
        $this->code = $exception->getCode();
    }


    public function setResponseContent($name = null, $invalidFields = [], $data = []){
        $responseErrors = new ResponseErrors();

        $content = $responseErrors->getResponseError($name);

        $this->code = $content['code'];
        $this->message = $content['message'];

        $this->invalidFields = $invalidFields;
        $this->data = $data;
    }
}