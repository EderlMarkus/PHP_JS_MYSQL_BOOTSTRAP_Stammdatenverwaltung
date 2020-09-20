<?php
require_once dirname(dirname(__FILE__), 2) . "/DAO/Mitarbeiter.php";

$DAO_OBJECT = new Mitarbeiter();

//Define what parameters you need for the API-Calls
$NEEDEDPARAMS = [
    "ADD" => ["id", "address", "birthdate", "dateEntry", "dateLeave", "name", "salary", "status"],
    "DELETE" => ["id"],
    "UPDATE" => ["id", "address", "birthdate", "dateEntry", "dateLeave", "name", "salary", "status"],
    "GET" => ["id"],
    "GETBYNAME" => ["name"],
    "GETLAST20" => [],
    "GETALL" => [],

];

$OBJECT_NAME = "Mitarbeiter";
