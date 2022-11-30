<?php

/**
 * A class for consuming the Ice and Fire API.
 *
 * @author Sleiman Rabah
 */
require_once './includes/helpers/WebServiceInvoker.php';
class PlayerInfoController extends WebServiceInvoker {

    private $request_options = Array(
        'headers' => Array('Accept' => 'application/json')
    );

    public function __construct() {
        parent::__construct($this->request_options);
    }

    /**
     * Fetches and parses a list of books from the Ice and Fire API.
     * 
     * @return array containing some information about books. 
     */
    function getplayerInfo() {
        $playersInfo = Array();
        $resource_uri = "https://www.thesportsdb.com/api/v1/json/2/searchplayers.php";
        $playersInfoData = $this->invoke($resource_uri);

        if (!empty($playersInfoData)) {
            // Parse the fetched list of books.   
            $playersInfoData = json_decode($playersInfoData, true);
            //var_dump($playersInfoData);exit;

            $index = 0;
            // Parse the list of books and retreive some  
            // of the contained information.
            foreach ($playersInfoData as $key => $playerInfo) {
                $playersInfo[$index]["strPlayer"] = $playerInfo["strPlayer"];
                // $playersInfo[$index]["isbn"] = $playerInfo["isbn"];
                // $playersInfo[$index]["authors"] = $playerInfo["authors"];
                // $playersInfo[$index]["mediaType"] = $playerInfo["mediaType"];
                // $playersInfo[$index]["country"] = $playerInfo["country"];
                // $playersInfo[$index]["released"] = $playerInfo["released"];
                //
                $index++;
            }
        }
        return $playersInfo;
    }

}
