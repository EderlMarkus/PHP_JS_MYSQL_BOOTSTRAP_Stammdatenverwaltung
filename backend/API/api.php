<?php
require_once dirname(dirname(__FILE__), 1) . "/const.php";
require_once dirname(dirname(__FILE__), 1) . "/setHeaders.php";
class API
{
    protected $service;
    protected $const;
    public $payload;

    public function __construct($service)
    {
        $headers = new Headers("https://edma.at/");
        $headers->setHeaders();
        $this->const = API_CONST;
        $this->service = $service;

    }

    public function add($payload)
    {
        return $this->service->add($payload);

    }

    public function deleteById($payload)
    {
        return $this->service->deleteById($payload);

    }

    public function updateById($payload)
    {
        return $this->service->updateById($payload["id"], $payload);

    }

    public function getById($payload)
    {

        return $this->service->getById($payload);

    }

    public function getByParameter($parameterName, $parameterValue)
    {
        return $this->service->getByParameter($parameterName, $parameterValue);
    }

    public function showError($logMessage)
    {
        array_push($this->const["ERRORS"], $logMessage);
        echo json_encode(["ERROR" => $this->const["ERRORS"]]);
    }

    public function showWarning($logMessage)
    {
        array_push($this->const["WARNINGS"], $logMessage);
        echo json_encode(["WARNING" => $this->const["WARNINGS"]]);
    }

    public function showSuccess($logMessage)
    {
        array_push($this->const["SUCCESS"], $logMessage);
        echo json_encode(["SUCCESS" => $this->const["SUCCESS"]]);

        die();
    }

    public function testInput($data)
    {
        if (is_array($data)) {
            return $this->testPayload($data);
        }

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function testPayload($payload)
    {

        $retArray = [];
        foreach ($payload as $data => $value) {
            $key = $this->testInput($data);
            $val = $this->testInput($value);
            $retArray[$key] = $val;
        }

        return $retArray;
    }

    public function checkIfParamsAreSet($payload, $params)
    {
        if (!$this->checkIfParamsAreValid($payload, $params)) {

            return false;
        }

        foreach ($params as $param) {

            if (!isset($payload[$param])) {
                return false;
            };
        }

        return true;
    }

    public function checkIfParamsAreValid($payload, $params)
    {
        foreach ($params as $param) {

            if (empty($payload[$param])) {
                $this->showError("No empty Values allowed.");
                return false;
            };

            switch (true) {
                case $param == 'birthdate' || $param == 'dateEntry' || $param == 'dateLeave' || $param == 'vacationStart' || $param == 'vacationEnd':
                    $str = $payload[$param];
                    $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
                    if (preg_match($pattern, $str) === 0) {
                        $this->showError("Invalid Date.");
                        return false;
                    }
                    break;
                case $param == "name":
                    $str = $payload[$param];
                    $pattern = '/^[a-zA-Z ]*$/';
                    if (preg_match_all($pattern, $str) === 0) {
                        $this->showError("Invalid Name.");
                        return false;
                    }
                    break;
                case $param == "status":
                    $str = strtolower($payload[$param]);
                    if ($str !== "aktiv" && $str !== "inaktiv") {
                        $this->showError("Invalid Status");
                        return false;
                    }
                    break;
                case $param == "salary":
                    $str = strtolower($payload[$param]);
                    $pattern = ' /^[0-9]*$/';
                    if (preg_match_all($pattern, $str) === 0) {
                        $this->showError("Invalid salary.");
                        return false;
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
        return true;
    }

}
