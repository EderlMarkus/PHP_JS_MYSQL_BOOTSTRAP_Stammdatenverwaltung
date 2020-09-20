<?php
require_once dirname(dirname(__FILE__), 1) . "/const.php";

/**
 * only job of this class is to connect to a database
 *
 */
class Connection
{

    protected $connection;
    protected $host = DATABASE_HOSTNAME;
    protected $dbname = DATABASE_DATABASENAME;
    protected $username = DATABASE_USERNAME;
    protected $password = DATABASE_PASSWORD;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
        } catch (PDOException $ex) {
            die("API ERROR: Connection Failure.");
        }
    }

}

$conn = new Connection();
