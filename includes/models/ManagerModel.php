<?php

class ManagerModel extends BaseModel {

    private $table_name = "manager";

    /**
     * A model class for the `manager` database table.
     * It exposes operations that can be performed on managers records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all teams from the `teams` table.
     * @return array A list of managers. 
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

    public function getManagersByContract($contract) {
        $sql = "SELECT * FROM manager WHERE contract = ?";
        $data = $this->rows($sql, [$contract]);
        return $data;
    }
    
    public function createManager($manager){
        $data = $this->insert($this->table_name, $manager) ;
        return $data;    
    }


    function updateManager($manager, $where){
        $data = $this->update("$this->table_name", $manager, $where);
        return $data;
    }

     /**
     * Delete information about one or more managers
     * @param string $manager_id: given manager
     */
    function deleteManager($manager_id){
        $data = $this->deleteByIds("$this->table_name", "ManagerId", $manager_id);
        return $data;
    }
}
