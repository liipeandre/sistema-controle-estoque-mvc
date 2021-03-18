<?php


trait RequestValidation {
    public function validRequest(){
        $regex = '/^[a-zA-Z_]+$/';
        return preg_match($regex, $this->name) && preg_match($regex, $this->action);
    }


    public function emptyRequest(){
        return $this->name === "" || $this->action === "";
    }


    public function isValidAuth(){
       return !$this->requireAuth ||
                ($this->requireAuth && isset($_SESSION["logged"]) && $_SESSION["logged"]);
    }


    private function breakRules($rules){
        $newRules = [];
        foreach ($rules as $rule){
            $regex = '/^(?<rule>[A-Za-z0-9_]+)(?::(?<value>\N+)){0,1}/';
            preg_match($regex, $rule, $matches);
            $newRules[$matches['rule']] = isset($matches['value']) ? $matches['value'] : true;
        }
        return $newRules;
    }


    private function removeFieldsWithoutRules($fieldRules){
        foreach($this->data as $field => $value){
            if(!array_key_exists($field, $fieldRules)){
                unset($this->data[$field]);
            }
        }
    }


    private function isRuleWithoutField($field){
        return !isset($this->data[$field]) || !array_key_exists($field, $this->data);
    }


    public function validateRequestData($fieldRules){
        $invalidFields = [];

        $response = new Response();

        $this->removeFieldsWithoutRules($fieldRules);

        foreach($fieldRules as $field => $rules){
            if($this->isRuleWithoutField($field)){
                $invalidFields[] = $field;
            }
            else{
                $rules = $this->breakRules($rules);
                $validField = $this->validateField($field, $rules);
                if(!$validField){
                    $invalidFields[] = $field;
                    $response->setResponseContent('INVALID_REQUEST_DATA');
                }
            }
        }

        if(!empty($invalidFields)){
            $response->setResponseContent('INVALID_REQUEST_DATA', $invalidFields);
        }
        else{
            $response->setResponseContent();
        }
        return $response;
    }


    public function validateField($field, $rules){
        return $this->isValidType($field, $rules) && $this->isValidAdditional($field, $rules);
    }
}