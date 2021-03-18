<?php


trait RequestDataValidation {
    protected function isValidAdditional($field, $rules){
        return $this->isValidRequired($field, $rules) &&
               $this->isValidMin($field, $rules) &&
               $this->isValidMax($field, $rules);
    }


    private function isValidRequired($field, $rules){
        $isRequired = isset($rules['required']);
        $isEmpty = preg_match('/^$/', $this->data[$field]);
        return !$isRequired || $isRequired && !$isEmpty;
    }


    private function isValidMin($field, $rules){
        $hasMin = isset($rules["min"]);

        if($hasMin){
            $validMin = null;
            $type = gettype($this->data[$field]);

            if($type == 'string'){
                $validMin = strlen($this->data[$field]) >= intval($rules["min"]);
            }
            else {
                $validMin = $this->data[$field] >= intval($rules["min"]);
            }
        }
        return !$hasMin || $hasMin && $validMin;
    }


    private function isValidMax($field, $rules){
        $hasMax = isset($rules["max"]);
        if($hasMax) {
            $validMax = null;
            $type = gettype($this->data[$field]);
            if ($type == 'string') {
                $validMax = strlen($this->data[$field]) <= intval($rules["max"]);
            } else {
                $validMax = $this->data[$field] <= intval($rules["max"]);
            }
        }
        return !$hasMax || $hasMax && $validMax;
    }
}