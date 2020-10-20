<?php
require_once "apiObject.php";
require_once dirname(dirname(__FILE__), 1) . "/const.php";

$payload = $_POST;
$requestMethod = 'POST';
$logMessageSuccess = $OBJECT_NAME . ' added';

$API_OBJECT = new API_OBJECT();

if ($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
    echo $API_OBJECT->showError("Wrong Request Method, needs to be $requestMethod.");
}

$_POST = $API_OBJECT->testInput($_POST);

if ($API_OBJECT->checkIfParamsAreSet($_POST, $NEEDEDPARAMS["ADD"])) {
    $requestSuccessfull = $API_OBJECT->handleRequest($_POST);
    if ($requestSuccessfull) {
        $API_OBJECT->showSuccess($logMessageSuccess);
    }
}
