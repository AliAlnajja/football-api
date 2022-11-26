<?php

class AssistModel extends BaseModel {

    private $table_name = "assist";

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
        $sql = "SELECT * FROM assist";
        $data = $this->paginate($sql);
        return $data;
    }

    public function getAssistsFromPlayer($player_id) {
        $sql = "SELECT * FROM assist WHERE PlayerId = ?";
        $data = $this->run($sql, [$player_id])->fetch();
        return $data;
    }

    public function getAssistsById($assist_id) {
        $sql = "SELECT * FROM assist WHERE AssistId = ?";
        $data = $this->run($sql, [$assist_id])->fetch();
        return $data;
    }

    public function createAssist($assist){
        $data = $this->insert($this->table_name, $assist) ;
        return $data;    
    }


    function updateAssist($assist, $where){
        $data = $this->update("$this->table_name", $assist, $where);
        return $data;
    }
}
