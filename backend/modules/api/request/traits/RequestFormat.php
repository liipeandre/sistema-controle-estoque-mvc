<?php


trait RequestFormat {
    public function toPascalCase($field, $subfield = null){
        $string = "";
        if(property_exists($this, $field)){
            if(isset($subfield) && isset($this->$field[$subfield])){
                $string = str_replace("_", " ", $this->$field[$subfield]);
            }
            else{
                $string = str_replace("_", " ", $this->$field);
            }
            $string = ucwords($string);
            $string = str_replace(" ", "", $string);
        }
        return $string;
    }


    public function toLowerCase($field, $subfield = null){
        $string = "";
        if(property_exists($this, $field)){
            if(isset($this->$field[$subfield])){
                $string = strtolower($this->$field[$subfield]);
            }
            else{
                $string = strtolower($this->$field);
            }
        }
        return $string;
    }


    public function toHash($field, $subfield = null){
        $string = "";
        if(property_exists($this, $field)){
            if(isset($this->$field[$subfield]) && array_key_exists($subfield, $this->$field)){
                $string = password_hash($this->$field[$subfield], PASSWORD_DEFAULT);
            }
            else{
                $string = password_hash($this->$field, PASSWORD_DEFAULT);
            }
        }
        return $string;
    }
}