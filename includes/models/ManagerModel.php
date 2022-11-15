<?php

class ManagerModel extends BaseModel {

    private $table_name = "manager";

    /**
     * A model class for the `artist` database table.
     * It exposes operations that can be performed on artists records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all teams from the `teams` table.
     * @return array A list of artists. 
     */
    public function getAll() {
        $sql = "SELECT * FROM manager";
        $data = $this->rows($sql);
        return $data;
    }

    public function getManagerById($manager_id) {
        $sql = "SELECT * FROM manager WHERE ManagerId = ?";
        $data = $this->run($sql, [$manager_id])->fetch();
        return $data;
    }
}
