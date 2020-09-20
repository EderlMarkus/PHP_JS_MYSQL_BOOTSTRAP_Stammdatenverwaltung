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

        return $this->service->getLast20Entries();

    }
}

$payload = $_GET;
$requestMethod = 'GET';

$API_OBJECT = new API_OBJECT($DAO_OBJECT);

if ($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
    echo $API_OBJECT->showError("Wrong Request Method, needs to be $requestMethod.");
}

$payload = $API_OBJECT->testInput($payload);

if (!$API_OBJECT->checkIfParamsAreSet($payload, $NEEDEDPARAMS["GETLAST20"])) {
    $API_OBJECT->showError("Invalid Parameters.");
}

echo json_encode($API_OBJECT->handleRequest($payload));
