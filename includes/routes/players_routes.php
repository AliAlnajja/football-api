<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/PlayerModel.php';


function handleGetAllPlayers(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

    if($input_page_number === null && $input_per_page === null){
        $input_page_number = 1;
        $input_per_page = 10;
    }
    
    $player_info = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $player_model = new PlayerModel();
    $player_model->setPaginationOptions($input_page_number, $input_per_page);

    $filter_params = $request->getQueryParams();
    if (isset($filter_params["position"])) {
        //get players by position
        $player_info = $player_model->getPlayersByPosition($filter_params["position"]);
    } else if (isset($filter_params["brand"])) {
        //get players by brand
        $player_info = $player_model->getPlayersByBrand($filter_params["brand"]);
    } else {
        $player_info = $player_model->getAll();
    }  
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($player_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetPlayerById(Request $request, Response $response, array $args) {
    $player_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $player_model = new PlayerModel();

    $player_id = $args["player_id"];
    
    if (isset($player_id)) {
        
        $player_info = $player_model->getPlayerById($player_id);
        if (!$player_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Player does not exist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($player_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleCreatePlayer(Request $request, Response $response) {
    $player_model = new PlayerModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;
    $table = "player";

    $player_id = "";
    $playerName = "";
    $playerAge = "";
    $playerPosition = "";
    $teamId = "";
    $playerWage = "";
    $playerHeight = "";
    $playerWeight = "";
    $playerCondition = "";
    $brandAssociation = "";
    $playerValue = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_player = $parsed_data[$index];
        $player_id = $single_player["PlayerId"];
        $playerName = $single_player["Name"];
        $playerAge = $single_player["Age"];
        $playerPosition = $single_player["position"];
        $teamId = $single_player["TeamId"];
        $playerWage = $single_player["Wages"];
        $playerHeight = $single_player["Height"];
        $playerWeight = $single_player["Weight"];
        $playerCondition = $single_player["P_Condition"];
        $brandAssociation = $single_player["BrandAssoc"];
        $playerValue = $single_player["Value"];


        $player_record = array("PlayerId" => $player_id, "Name" => $playerName, "Age" => $playerAge, "position" => $playerPosition,
            "TeamId" => $teamId, "Wages" => $playerWage, "Height" => $playerHeight, "Weight" => $playerWeight, "P_Condition" => $playerCondition,
            "BrandAssoc" => $brandAssociation, "Value" => $playerValue);

        $player_model->create($table, $player_record);
    }

    if($response_code === HTTP_CREATED){
        $response_data = json_encode(getSuccessCreated());
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Delete a given player
function handleDeletePlayer(Request $request, Response $response, array $args) {
    $team_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $player_model = new PlayerModel();

    $player_id = $args["player_id"];
    
    $player_count = $player_model->getPlayerById($player_id);
    if (!$player_count){
        $response_data = json_encode(getErrorNotFound());
        $response_code = HTTP_NOT_FOUND;
        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    } 

    if (isset($player_id)) {
        $player_model->deletePlayer($player_id);
    } 
    else {
        $response_data = makeCustomJSONError("resourceNotFound", "You must specify an team id!");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }    
    
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode(getSuccessDelete());
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdatePlayer(Request $request, Response $response) {
    $player_Model = new PlayerModel();
    $response_data = array();
    $response_code = HTTP_OK;
    $parsed_data = $request->getParsedBody();
    $table = "player";

    $player_id = "";
    $playerName = "";
    $playerAge = "";
    $playerPosition = "";
    $teamId = "";
    $playerWage = "";
    $playerHeight = "";
    $playerWeight = "";
    $playerCondition = "";
    $brandAssociation = "";
    $playerValue = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_player = $parsed_data[$index];
        $player_id = $single_player["PlayerId"];
        $playerName = $single_player["Name"];
        $playerAge = $single_player["Age"];
        $playerPosition = $single_player["position"];
        $teamId = $single_player["TeamId"];
        $playerWage = $single_player["Wages"];
        $playerHeight = $single_player["Height"];
        $playerWeight = $single_player["Weight"];
        $playerCondition = $single_player["P_Condition"];
        $brandAssociation = $single_player["BrandAssoc"];
        $playerValue = $single_player["Value"];

        $player_record = array("Name" => $playerName, "Age" => $playerAge, "position" => $playerPosition,
        "TeamId" => $teamId, "Wages" => $playerWage, "Height" => $playerHeight, "Weight" => $playerWeight, "P_Condition" => $playerCondition,
        "BrandAssoc" => $brandAssociation, "Value" => $playerValue);

        $player_condition = array("PlayerId" => $player_id);
        $player_Model->updateTable($table, $player_record, $player_condition);
    }
    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response;
}
