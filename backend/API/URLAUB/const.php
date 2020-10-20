<?php
require_once dirname(dirname(__FILE__), 2) . "/DAO/Urlaub.php";

$DAO_OBJECT = new Urlaub();

//Define what parameters you need for the API-Calls
$NEEDEDPARAMS = [
    "ADD" => ["id", "vacationStart", "vacationEnd"],
    "DELETE" => ["id"],
    "ADD" => ["id", "vacationStart", "vacationEnd"],
    "GET" => ["id"],
];

$OBJECT_NAME = "Urlaub";
