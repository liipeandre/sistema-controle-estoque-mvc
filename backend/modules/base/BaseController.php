<?php

require_once "BaseComponent.php";

require_once __DIR__ . '/../controller/modules/Auth.php';


abstract class BaseController extends BaseComponent {
    protected $model;

    protected $auth;

    public function __construct($name) {
        $this->model = $this->getComponent($name, "Model");
        $this->auth = new Auth();
    }
}