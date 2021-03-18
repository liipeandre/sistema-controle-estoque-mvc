<?php

require_once __DIR__ . "/api/Api.php";

header('Content-Type: application/json; charset=utf-8');

$api = new Api();

$request = new Request('async');
$response = $api->process($request);