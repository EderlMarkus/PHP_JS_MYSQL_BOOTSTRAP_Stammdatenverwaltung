<?php
require_once dirname(__FILE__) . "/dataObject.php";

class Mitarbeiter extends DataObject
{

    public function __construct()
    {
        parent::__construct("mitarbeiter");
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
            name VARCHAR(255),
            address VARCHAR(255),
            birthdate VARCHAR(255),
            dateEntry VARCHAR(255),
            dateLeave VARCHAR(255),
            salary VARCHAR(255),
            status VARCHAR(255),
            addedOn BIGINT,
            PRIMARY KEY (id)
            )";
        $pdo->query($sql);
    }

    public function getByName($name)
    {
        $pdo = $this->connection;

        $sql = "SELECT id, name, address, birthdate, dateEntry, dateLeave, salary, status FROM $this->table WHERE name LIKE :name";
        $name = "%$name%";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $name);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($results) === 0) {
            return null;
        }
        return $results;

    }

    public function getAll()
    {
        $pdo = $this->connection;

        $sql = "SELECT id, name, address, birthdate, dateEntry, dateLeave, salary, status FROM $this->table";
        $statement = $pdo->prepare($sql);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($results) === 0) {
            return null;
        }
        return $results;

    }

    public function getLast20Entries()
    {
        $sql = "SELECT * From `sqa_fernlehre01_mitarbeiter` order by addedOn desc limit 20";
        if (sizeof($this->executeQuery($sql, [])) === 0) {
            return null;
        }
        return $this->executeQuery($sql, []);

    }

}
