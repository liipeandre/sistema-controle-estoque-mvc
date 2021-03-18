<?php

require_once __DIR__ . "/../database/DatabaseHandler.php";
require_once __DIR__ . "/../base/BaseComponent.php";


abstract class BaseModel extends BaseComponent {
    protected $databaseHandler;

    public function __construct() {
        $this->databaseHandler = new DatabaseHandler();
        $this->databaseHandler->beginTransaction();
    }


    public function __destruct() {
        $this->databaseHandler->commit();
    }
}