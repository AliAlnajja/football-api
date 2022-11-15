<?php

class LeagueModel extends BaseModel {

    private $table_name = "league";

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
        $sql = "SELECT * FROM league";
        $data = $this->rows($sql);
        return $data;
    }

    public function getLeagueById($league_id) {
        $sql = "SELECT * FROM league WHERE LeagueId = ?";
        $data = $this->run($sql, [$league_id])->fetch();
        return $data;
    }

}
