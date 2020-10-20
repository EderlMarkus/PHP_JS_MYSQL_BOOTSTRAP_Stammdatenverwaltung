<?php
require_once dirname(__FILE__) . "/dataObject.php";

class Urlaub extends DataObject
{

    public function __construct()
    {
        parent::__construct("urlaub");
        //if Table does not yet exist in database create it
        if (!$this->checkIfTableExists()) {
            $this->createTableInDataBase();
        }

    }

    /**
     * createTableInDataBase creates table in database
     *
     * @return void
     */
    private function createTableInDataBase()
    {
        $pdo = $this->connection;
        $sql = "CREATE TABLE $this->table (
            id VARCHAR(255) NOT NULL,
            vacationStart VARCHAR(255),
            vacationEnd VARCHAR(255),
            addedOn BIGINT,
            PRIMARY KEY (addedOn)
            )";
        $pdo->query($sql);
    }

}
