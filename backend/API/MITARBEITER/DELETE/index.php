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

        return $this->deleteById($payload["id"]);

    }
}

$payload = $_POST;
$requestMethod = 'POST';
$logMessageSuccess = $OBJECT_NAME . ' deleted';

$API_OBJECT = new API_OBJECT($DAO_OBJECT);

if ($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
    echo $API_OBJECT->showError("Wrong Request Method, needs to be $requestMethod.");
}

$payload = $API_OBJECT->testInput($payload);

if (!$API_OBJECT->checkIfParamsAreSet($payload, $NEEDEDPARAMS["DELETE"])) {
    $API_OBJECT->showError("Invalid Parameters.");
}

$requestSuccessfull = $API_OBJECT->handleRequest($payload);

if ($requestSuccessfull) {
    $API_OBJECT->showSuccess($logMessageSuccess);
}
