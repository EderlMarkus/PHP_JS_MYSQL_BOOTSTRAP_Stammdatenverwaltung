<?php

require_once "connection.php";

class DataObject extends Connection
{
    public $table;

    public function __construct($table)
    {

        parent::__construct();
        require_once dirname(dirname(__FILE__), 1) . "/const.php";
        $this->setTable($table);
        $this->checkIfTableExists();

    }

    /**
     * Set the value of table
     *
     */
    public function setTable($table)
    {
        $this->table = DATABASE_PREFIX . $table;
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * checkIfTableExists checks if the table exists in database
     * Do you really need a comment for this?
     * @return boolean true if it does, false otherwise
     */
    protected function checkIfTableExists()
    {
        $pdo = $this->connection;
        $sql = "SELECT *
        FROM information_schema.tables
        WHERE table_schema = ?
            AND table_name = ?
        LIMIT 1;";

        try {

            $query = $pdo->prepare($sql);
            $query->execute(array($this->dbname, $this->table));
            $result = $query->fetchAll();

        } catch (Exception $e) {
            return false;
        }

        return sizeOf($result) !== 0;
    }

    /**
     * executeQuery executes SQL-Query, returns fales if exception is catched,
     * but does not throw exception
     * TODO: Put that in the parent, doesnT
     * @param  string $sql SQL-Statement (with PDO Parameters)
     * @param  array $parameters array with PDO-Parameter-Keys
     *
     * @return boolean result if everything worked, false if something went wrong
     */
    protected function executeQuery($sql, $parameters)
    {
        $pdo = $this->connection;
        try {
            $query = $pdo->prepare($sql);
            $query->execute($parameters);
            //fetch only values
            $result = $query->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            return false;
        }
        return $result;
    }

    public function add($valueArray)
    {

        $i = 0;
        $values = [];
        $valuesPlaceholder = "(";
        $columnnames = "(";
        foreach ($valueArray as $key => $value) {
            array_push($values, $value);
            if (++$i !== count($valueArray)) {
                $columnnames .= $key . ",";
                $valuesPlaceholder .= "?,";
            } else {
                $columnnames .= $key . ")";
                $valuesPlaceholder .= "?)";
            }
        }

        $sql = "INSERT INTO  $this->table $columnnames VALUES $valuesPlaceholder";

        return $this->executeQuery($sql, $values) !== false;

    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = '$id'";
        return $this->executeQuery($sql, [$id]) !== false;
    }

    public function updateById($id, $valueArray)
    {

        $sql = "UPDATE $this->table SET ";

        $values = [];
        $i = 0;
        foreach ($valueArray as $key => $value) {
            $sql .= $key . "= ?";
            array_push($values, $value);
            if (++$i !== count($valueArray)) {
                $sql .= ", ";
            }
        }

        $sql .= " WHERE id = ?";

        array_push($values, $id);
        return $this->executeQuery($sql, $values) !== false;

    }

    public function getById($id)
    {

        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $result = $this->executeQuery($sql, [$id]);

        if (sizeof($result) === 0) {
            return null;
        }
        return $result[0];
    }

}
