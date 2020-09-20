<?php

// DATABASE CONSTANTS
// CONNECTION

// // Database const Testing
define("DATABASE_HOSTNAME", "localhost");
define("DATABASE_DATABASENAME", "sqa_fernlehre01");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");
define("DATABASE_PREFIX", "sqa_fernlehre01_");

// API_CONST Variable to be used in the Project
$API_CONST = [
    "ERRORS" => ["FAILURE"],
    "SUCCESS" => ["SUCCESS"],
];

define("API_CONST", $API_CONST);
