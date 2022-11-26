<?php

class FixtureModel extends BaseModel {

    private $table_name = "fixture";

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
        $sql = "SELECT * FROM fixture";
        $data = $this->rows($sql);
        return $data;
    }

    public function getFixturesFromTeam($team_id) {
        $sql = "SELECT * FROM fixture WHERE TeamId = ?";
        $data = $this->run($sql, [$team_id])->fetchAll();
        return $data;
    }

    public function getFixtureById($fixture_id) {
        $sql = "SELECT * FROM fixture WHERE FixtureId = ?";
        $data = $this->run($sql, [$fixture_id])->fetch();
        return $data;
    }

    public function getFixturesByWeather($weather) {
        $sql = "SELECT * FROM fixture WHERE Weather_Cond = ?";
        $data = $this->rows($sql, [$weather]);
        return $data;
    }

    public function createFixture($fixture){
        $data = $this->insert($this->table_name, $fixture) ;
        return $data;    
    }


    function updateFixture($fixture, $where){
        $data = $this->update("$this->table_name", $fixture, $where);
        return $data;
    }

     /**
     * Delete information about one or more fixtures
     * @param string $fixture_id: given fixture
     */
    function deleteFixture($fixture_id){
        $data = $this->deleteByIds("$this->table_name", "FixtureId", $fixture_id);
        return $data;
    }
}
