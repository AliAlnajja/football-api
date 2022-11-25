<?php

class CardModel extends BaseModel {

    private $table_name = "card";

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
        $sql = "SELECT * FROM card";
        $data = $this->paginate($sql);
        return $data;
    }

    public function getCardsFromPlayer($player_id) {
        $sql = "SELECT * FROM card WHERE PlayerId = ?";
        $data = $this->run($sql, [$player_id])->fetch();
        return $data;
    }

    public function getCardsByType($type) {
        $sql = "SELECT * FROM card WHERE CardType = ?";
        $data = $this->rows($sql, [$type]);
        return $data;
    }

    /**
     * Create a new card      
     * @param array $data an array that has the values of the new card 
     * @return array An array containing the new card.
     */
    public function createCard($data) {
        $data = $this->insert("card",$data);
        return $data;
    }

    /**
     * Update an existing card.       
     * @param array $data an array that has the new values of the existing card
     * @param array $where an array that holds the conditions about a specific card 
     * @return array An array containing the returned data
     */
    public function updateCard($data, $where) {
        $data = $this->update("card", $data, $where);
        return $data;
    }
}
