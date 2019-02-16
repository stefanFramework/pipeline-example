<?php

function loadModule($directory)
{
    foreach (glob($directory) as $lib) {
        if (!file_exists($lib)) {
            die($lib . ' not found');
        }

        require_once $lib;
    }
}

loadModule('Controllers/*.php');

$url = filter_input(INPUT_GET, "url");
$urlArray = explode("/", $url);

$controllerName = ucfirst($urlArray[0]);
array_shift($urlArray);
$action = $urlArray[0];
array_shift($urlArray);
$arguments = $urlArray;

$controller = "Controllers\\" . $controllerName . "Controller";
$obj = new $controller();

if (!method_exists($obj, $action)) {
    die('Action ' . $action . 'does not exists');
}

call_user_func_array(array($obj, $action), $arguments);



//
//class ECommerceContext extends \Pipeline\PipelineContext
//{
//    private $result = [];
//
//    public function getResult() {
//        return $this->result;
//    }
//
//    public function addResult($someResult) {
//        $this->result[] = $someResult;
//    }
//}
//
//class CreateOrder extends \Pipeline\PipelineStep
//{
//    public function execute()
//    {
//
//    }
//}
//
//class PerformPayment
//{
//    public function __invoke(Context $ctx) {
//        $ctx->addResult('Payment Successfull');
//    }
//}
//
//class GenerateInvoice
//{
//    public function __invoke(Context $ctx) {
//        $ctx->addResult('Invoice Generated');
//    }
//}
//
//class NotifyClient
//{
//    public function __invoke(Context $ctx) {
//        $ctx->addResult('Notification Email sent');
//    }
//}
//
//
