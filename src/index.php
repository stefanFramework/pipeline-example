<?php
require_once 'autoload.php';

$url = filter_input(INPUT_GET, "url");
$urlArray = explode("/", $url);

$controllerName = ucfirst($urlArray[0]);
array_shift($urlArray);
$action = $urlArray[0];
array_shift($urlArray);
$arguments = $urlArray;

$controller = "App\\Controllers\\" . $controllerName . "Controller";

$obj = new $controller();

if (!method_exists($obj, $action)) {
    die('Action ' . $action . 'does not exists');
}

call_user_func_array(array($obj, $action), $arguments);