<?php
require_once dirname(dirname(__FILE__), 2) . "/api.php";
require_once dirname(dirname(__FILE__), 3) . "/DAO/Mitarbeiter.php";
require_once dirname(dirname(__FILE__), 1) . "/const.php";
require_once dirname(dirname(__FILE__), 3) . "/DAO/Urlaub.php";

class API_OBJECT extends API
{

    public function __construct()
    {
        parent::__construct(new Urlaub());
        $this->mitarbeiter = new Mitarbeiter();
    }

    public function handleRequest($payload)
    {
        $date = new DateTime();
        $payload["addedOn"] = $date->getTimestamp();
        return $this->add($payload);

    }

    public function checkIfParamsAreValid($payload, $params)
    {

        foreach ($params as $param) {

            if (empty($payload[$param])) {
                $this->showError("No empty Values allowed.");
                return false;
            };

            switch (true) {
                case $param == 'vacationStart' || $param == 'vacationEnd':
                    $str = $payload[$param];
                    $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
                    if (preg_match($pattern, $str) === 0) {
                        $this->showError("Invalid Date.");
                        return false;

                    }
                    break;
                case $param == "id":
                    $str = $payload[$param];
                    $pattern = "/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}-uniqueId/";
                    if (preg_match($pattern, $str) === 0) {
                        $this->showError("Invalid Id.");
                        return false;
                    }
                    $foundIds = $this->mitarbeiter->getById($str);

                    if (!isset($foundIds)) {
                        $this->showError("No Mitarbeiter with requested Id found.");
                        return false;
                    }
                default:
                    # code...
                    break;
            }
        }

        $start = $payload["vacationStart"];
        $end = $payload["vacationEnd"];

        if ($this->checkIfVacationIsInPast($start, $end)) {
            $this->showError("Dates must not be in past.");
            return false;
        };

        if ($this->vacationPeriodIsGreaterThan2Weeks($start, $end)) {
            $this->showError("Vacation must not be greater than 2 Weeks.");
            return false;

        };

        return true;
    }

    private function checkIfVacationIsInPast($start, $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);

        return $start < time() || $end < time();
    }

    private function secondsToDays($seconds)
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return intval($dtF->diff($dtT)->format('%a'));
    }

    private function vacationPeriodIsGreaterThan2Weeks($start, $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);

        $days = $this->secondsToDays($end - $start);

        return $days > 14;

    }
}
