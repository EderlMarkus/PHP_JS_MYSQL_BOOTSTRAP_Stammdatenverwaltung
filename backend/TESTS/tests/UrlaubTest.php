<?php
use PHPUnit\Framework\TestCase;

require_once dirname(dirname(__FILE__), 2) . "/API/URLAUB/ADD/apiObject.php";

final class UrlaubTest extends TestCase
{

    private function getTestData()
    {
        $testdata = [
            [
                "id" => "fd8052b7-0c6d-4d1a-83e9-299f0b4e05a8-uniqueId",
                "vacationStart" => "2020-12-01",
                "vacationEnd" => "2020-12-10",
            ],
            [
                "id" => "blabla",
                "vacationStart" => "2021-10-17",
                "vacationEnd" => "2021-10-30",
            ],
            [
                "id" => "fd8052b7-0c6d-4d1a-83e9-299f0b4e05a8-uniqueId",
                "vacationStart" => "iwuowerw",
                "vacationEnd" => "2021-10-30",
            ],
            [
                "id" => "fd8052b7-0c6d-4d1a-83e9-299f0b4e05a8-uniqueId",
                "vacationStart" => "2020-10-17",
                "vacationEnd" => "asfwere",
            ],
            [
                "id" => "fd8052b7-0c6d-4d1a-83e9-299f0b4e05a8-uniqueId",
                "vacationStart" => "2020-10-17",
                "vacationEnd" => "2021-10-20",
            ],
            [
                "id" => "fd8052b7-0c6d-4d1a-83e9-299f0b4e05a8-uniqueId",
                "vacationStart" => "2020-12-17",
                "vacationEnd" => "2021-12-30",
            ],
        ];

        return $testdata;
    }

    public function testHandleValidRequestCorrectly()
    {
        $testData = $this->getTestData()[0];
        $urlaub = new API_OBJECT();
        $params = ["id", "vacationStart", "vacationEnd"];
        $this->assertTrue(
            $urlaub->checkIfParamsAreValid($testData, $params));
    }

    public function testHandleInvalidIdCorrectly()
    {
        $testData = $this->getTestData()[1];
        $urlaub = new API_OBJECT();
        $params = ["id", "vacationStart", "vacationEnd"];
        $this->assertFalse(
            $urlaub->checkIfParamsAreValid($testData, $params));
    }

    public function testHandleInvalidStartDateCorrectly()
    {
        $testData = $this->getTestData()[2];
        $urlaub = new API_OBJECT();
        $params = ["id", "vacationStart", "vacationEnd"];
        $this->assertFalse(
            $urlaub->checkIfParamsAreValid($testData, $params));
    }

    public function testHandleInvalidEndDateCorrectly()
    {
        $testData = $this->getTestData()[3];
        $urlaub = new API_OBJECT();
        $params = ["id", "vacationStart", "vacationEnd"];
        $this->assertFalse(
            $urlaub->checkIfParamsAreValid($testData, $params));
    }

    private function getCorrectAnswer($testData, $OutputString)
    {
        $urlaub = new API_OBJECT();
        $params = ["id", "vacationStart", "vacationEnd"];
        $this->expectOutputString($OutputString);
        print($urlaub->checkIfParamsAreValid($testData, $params));

    }

    public function testGiveCorrectAnswerToInvalidId()
    {
        $testData = $this->getTestData()[1];
        $OutputString = '{"ERROR":["FAILURE","Invalid Id."]}';
        $this->getCorrectAnswer($testData, $OutputString);

    }

    public function testGiveCorrectAnswerToInvalidStartDate()
    {

        $testData = $this->getTestData()[2];
        $OutputString = '{"ERROR":["FAILURE","Invalid Date."]}';
        $this->getCorrectAnswer($testData, $OutputString);

    }

    public function testGiveCorrectAnswerToInvalidEndDate()
    {

        $testData = $this->getTestData()[3];
        $OutputString = '{"ERROR":["FAILURE","Invalid Date."]}';
        $this->getCorrectAnswer($testData, $OutputString);

    }

    public function testHandleInvalidDatePeriod()
    {

        $testData = $this->getTestData()[5];
        $OutputString = '{"ERROR":["FAILURE","Vacation must not be greater than 2 Weeks."]}';
        $this->getCorrectAnswer($testData, $OutputString);

    }

    public function testHandlePastDateGiven()
    {

        $testData = $this->getTestData()[4];
        $OutputString = '{"ERROR":["FAILURE","Dates must not be in past."]}';
        $this->getCorrectAnswer($testData, $OutputString);

    }

}
