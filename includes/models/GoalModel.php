<?php

class GoalModel extends BaseModel {

    private $table_name = "goal";

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
        $sql = "SELECT * FROM goal";
        $data = $this->paginate($sql);
        return $data;
    }

    public function getGoalsFromPlayer($player_id) {
        $sql = "SELECT * FROM goal WHERE PlayerId = ?";
        $data = $this->run($sql, [$player_id])->fetch();
        return $data;
    }

    public function getGoalsById($goal_id) {
        $sql = "SELECT * FROM goal WHERE GoalId = ?";
        $data = $this->run($sql, [$goal_id])->fetch();
        return $data;
    }

    public function getGoalsByAmount($amount) {
        $sql = "SELECT * FROM goal WHERE Amount = ?";
        $data = $this->rows($sql, [$amount]);
        return $data;
    }


    public function createGoal($goal){
        $data = $this->insert($this->table_name, $goal) ;
        return $data;    
    }


    function updateGoal($goal, $where){
        $data = $this->update("$this->table_name", $goal, $where);
        return $data;
    }
}
