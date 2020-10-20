<?php
require_once dirname(dirname(__FILE__), 2) . "/api.php";
require_once dirname(dirname(__FILE__), 1) . "/const.php";

class API_OBJECT extends API
{

    public function __construct($service)
    {
        parent::__construct($service);
    }

    public function handleRequest($payload)
    {
        $date = new DateTime();
        $payload["addedOn"] = $date->getTimestamp();
        return $this->add($payload);

    }
}

$payload = $_POST;
$requestMethod = 'POST';
$logMessageSuccess = $OBJECT_NAME . ' added';

$API_OBJECT = new API_OBJECT($DAO_OBJECT);

if ($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
    echo $API_OBJECT->showError("Wrong Request Method, needs to be $requestMethod.");
}

$_POST = $API_OBJECT->testInput($_POST);

if (!$API_OBJECT->checkIfParamsAreSet($_POST, $NEEDEDPARAMS["ADD"])) {
    $API_OBJECT->showError("Invalid Parameters.");
}

$requestSuccessfull = $API_OBJECT->handleRequest($_POST);

if ($requestSuccessfull) {
    $API_OBJECT->showSuccess($logMessageSuccess);
}
