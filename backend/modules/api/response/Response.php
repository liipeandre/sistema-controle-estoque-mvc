<?php

require_once "traits/ResponseValidation.php";
require_once "traits/ResponseFormat.php";
require_once "traits/ResponseInitialization.php";
require_once "traits/ResponseTypesValidation.php";
require_once "traits/ResponseErrors.php";


class Response extends RuntimeException {
    use ResponseInitialization;
    use ResponseTypesValidation;
    use ResponseValidation;
    use ResponseFormat;

    protected $code;
    protected $message;
    private $data;
    private $invalidFields;

    public function __construct() {
        parent::__construct("", 0);
        $this->data = [];
        $this->invalidFields = [];
    }


    public function getInvalidFields() {
        return $this->invalidFields;
    }


    public function getData($field = '', $toArray = false) {
        if ($this->isArrayList() && !$toArray) {
            if(isset($this->data[0][$field])){
                return $this->data[0][$field];
            }
            return $this->data[0];
        }
        return $this->data;
    }
}