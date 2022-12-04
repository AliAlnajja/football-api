<?php

class StadiumModel extends BaseModel {

    private $table_name = "stadium";

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
        $sql = "SELECT * FROM stadium";
        $data = $this->rows($sql);
        return $data;
    }

    public function getStadiumFromTeam($team_id) {
        $sql = "SELECT * FROM stadium WHERE TeamId = ?";
        $data = $this->run($sql, [$team_id])->fetch();
        return $data;
    }

    public function getStadiumByName($name) {
        $sql = "SELECT * FROM stadium WHERE Name = ?";
        $data = $this->rows($sql, [$name]);
        return $data;
    }

    public function getStadiumByCity($city) {
        $sql = "SELECT * FROM stadium WHERE City = ?";
        $data = $this->rows($sql, [$city]);
        return $data;
    }    
}
