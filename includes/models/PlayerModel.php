<?php

class PlayerModel extends BaseModel {

    private $table_name = "player";

    /**
     * A model class for the `player` database table.
     * It exposes operations that can be performed on player records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all teams from the `teams` table.
     * @return array A list of players. 
     */
    public function getAll() {
        $sql = "SELECT * FROM player";
        $data = $this->rows($sql);
        return $data;
    }

    public function getPlayerById($player_id) {
        $sql = "SELECT * FROM player WHERE PlayerId = ?";
        $data = $this->run($sql, [$player_id])->fetch();
        return $data;
    }

    public function getPlayersByPosition($position) {
        $sql = "SELECT * FROM player WHERE Position = ?";
        $data = $this->rows($sql, [$position]);
        return $data;
    }

    public function getPlayersByBrand($brand) {
        $sql = "SELECT * FROM player WHERE BrandAssoc = ?";
        $data = $this->rows($sql, [$brand]);
        return $data;
    }
}
