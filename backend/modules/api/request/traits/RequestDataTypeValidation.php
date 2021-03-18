<?php


trait RequestDataTypeValidation {
    protected function isValidType($field, $rules){
        $response = null;
        switch ($rules['type']){
            case 'custom':
                $response = $this->isCustom($field, $rules);
                break;

            case 'alphanumerictext':
                $response = $this->isAlphaNumericText($field);
                break;

            case 'alphatext':
                $response = $this->isAlphaText($field);
                break;

            case 'text':
                $response = $this->isText($field);
                break;

            case 'date':
                $response = $this->isDate($field);
                break;

            case 'time':
                $response = $this->isTime($field);
                break;

            case 'datetime':
                $response = $this->isDateTime($field);
                break;

            case 'decimal':
                $response = $this->isDecimal($field);
                break;

            case 'money':
                $response = $this->isMoney($field);
                break;

            default:
                $response = $this->isInteger($field);
        }
        return $response;
    }


    private function isCustom($field, $rules) {
        return isset($rules["regex"]) && preg_match($rules["regex"], $this->data[$field]);
    }


    private function isAlphaNumericText($field) {
        return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÂÊÎÔÛÃÕÀÈÌÒÙÇâêîôûãõàèìòùç _0-9]{0,}$/', $this->data[$field]);
    }


    private function isAlphaText($field) {
        return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÂÊÎÔÛÃÕÀÈÌÒÙÇâêîôûãõàèìòùç _]{0,}$/', $this->data[$field]);
    }


    private function isText($field) {
        return preg_match('/^[\w\s\p{L}\p{M}\p{Z}\p{N}\p{P}\p{S}\p{C}]{0,}$/u', $this->data[$field]);
    }


    private function isDate($field) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->data[$field]);
    }


    private function isTime($field) {
        return preg_match('/^\d{2}[:]\d{2}$/', $this->data[$field]);
    }


    private function isDateTime($field) {
        return preg_match('/^\d{4}-\d{2}-\d{2} \d{2}[:]\d{2}$/', $this->data[$field]);
    }


    private function isInteger($field) {
        return preg_match('/^[+-]{0,1}\d{0,}$/', $this->data[$field]);
    }


    private function isDecimal($field) {
        return preg_match('/^[+-]{0,1}\d+(?:[.]\d+){0,1}$/', $this->data[$field]);
    }


    private function isMoney($field) {
        return preg_match('/^[+-]{0,1}\d+(?:[.]\d{2,2}){0,1}$/', $this->data[$field]);
    }
}