<?php

/**
 * A class for consuming the Ice and Fire API.
 *
 * @author Ali Alnajjar
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
    function getPlayerInfo() {
        $playersInfo = Array();
        $team = $_GET["t"] ;
        $player = $_GET["p"] ;
        //$resource_uri = "https://www.thesportsdb.com/api/v1/json/2/searchplayers.php?t=arsenal&p=jesus";
        $resource_uri = "https://www.thesportsdb.com/api/v1/json/2/searchplayers.php?t=$team&p=$player";
        $playersInfoData = $this->invoke($resource_uri);

        if (!empty($playersInfoData)) {
            // Parse the fetched list of books.   
            $playersInfoData = json_decode($playersInfoData, true);
            // echo $playersInfoData["player"][0]["strPlayer"]; exit;            
            // var_dump($playersInfoData);exit;

            $index = 0;
            // Parse the list of books and retreive some  
            // of the contained information.
            // if (isset)
            foreach ($playersInfoData as $key => $playerInfo) {
                //-- Pull/select some information about the obtained player.
                $playersInfo[$index]["strPlayer"] = $playersInfoData["player"][$index]["strPlayer"];
                $playersInfo[$index]["strAgent"] = $playersInfoData["player"][$index]["strAgent"];
                $playersInfo[$index]["strBirthLocation"] = $playersInfoData["player"][$index]["strBirthLocation"];
                $playersInfo[$index]["strNationality"] = $playersInfoData["player"][$index]["strNationality"];
                $playersInfo[$index]["dateBorn"] = $playersInfoData["player"][$index]["dateBorn"];
                $playersInfo[$index]["strNumber"] = $playersInfoData["player"][$index]["strNumber"];
                $playersInfo[$index]["strSigning"] = $playersInfoData["player"][$index]["strSigning"];
                $playersInfo[$index]["strKit"] = $playersInfoData["player"][$index]["strKit"];
                $playersInfo[$index]["strStatus"] = $playersInfoData["player"][$index]["strStatus"];
                $playersInfo[$index]["strHeight"] = $playersInfoData["player"][$index]["strHeight"];
                $playersInfo[$index]["strGender"] = $playersInfoData["player"][$index]["strGender"];
                $playersInfo[$index]["strSide"] = $playersInfoData["player"][$index]["strSide"];
                $playersInfo[$index]["strPosition"] = $playersInfoData["player"][$index]["strPosition"];
                $playersInfo[$index]["strTwitter"] = $playersInfoData["player"][$index]["strTwitter"];
                $playersInfo[$index]["strInstagram"] = $playersInfoData["player"][$index]["strInstagram"];
                $playersInfo[$index]["strFacebook"] = $playersInfoData["player"][$index]["strFacebook"];
                $index++;
            }
        }
        return $playersInfo;
    }

}
