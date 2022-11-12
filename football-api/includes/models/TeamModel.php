<?php

class TeamModel extends BaseModel {

    private $table_name = "teams";

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
        $sql = "SELECT * FROM teams";
        $data = $this->rows($sql);
        return $data;
    }

     /**
     * Retrieve a team by its id.
     * @param int $team_id the id of the team.
     * @return array an array containing information about a given team.
     */
    public function getTeamById($team_id) {
        $sql = "SELECT * FROM teams WHERE TeamId = ?";
        $data = $this->run($sql, [$team_id])->fetch();
        return $data;
    }

    /**
     * Create a new team      
     * @param array $data an array that has the values of the new team 
     * @return array An array containing the new team.
     */
    public function createTeam($data) {
        $data = $this->insert("teams",$data);
        return $data;
    }

    /**
     * Delete a specifc team.       
     * @param int $team_id the id that specifies the team that will be delete
     * @return array An array containing the returned data
     */
    public function deleteTeam($team_id) {
        $sql = "DELETE FROM teams WHERE TeamId = :TeamId";
        $data = $this->run($sql, [":TeamId" => $team_id . "%"])->execute();
        return $data;
    }

    /**
     * Update an existing team.       
     * @param array $data an array that has the new values of the existing team
     * @param array $where an array that holds the conditions about a specific team 
     * @return array An array containing the returned data
     */
    public function updateTeam($data, $where) {
        $data = $this->update("teams", $data, $where);
        return $data;
    }
}
}
