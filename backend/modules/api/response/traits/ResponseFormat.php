<?php


trait ResponseFormat {
    public function toJson() {
        return json_encode($this->toArray(), JSON_FORCE_OBJECT);
    }


    public function __toString() {
        return json_encode($this->toArray(), JSON_FORCE_OBJECT);
    }


    public function toArray() {
        return [
            "code" => $this->code,
            "message" => $this->message,
            "invalid_fields" => $this->invalidFields,
            "data" => $this->data
        ];
    }
}