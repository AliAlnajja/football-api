<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/TeamModel.php';


// Get all artists
function handleGetAllTeams(Request $request, Response $response, array $args) {
    //Creating array to store artist info
    $team_info = array();
    
    //Creating array to store artist info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    //Fetching all customer info
    $team_info = $team_model->getAll();
        
   //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($team_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Get the details of a given team
function handleGetTeamById(Request $request, Response $response, array $args) {
    $team_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $team_id = $args["team_id"];
    
    if (isset($team_id)) {
        $team_info = $team_model->getTeamById($team_id);
        if (!$team_info) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified artist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($team_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Create one or more teams
function handleCreateTeam(Request $request, Response $response) {
    $team_model = new TeamModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    $team_id = "";
    $teamName = "";
    $teamTotalTrop = "";
    $teamFD = "";
    $teamCountry = "";
    $teamValue = "";
    $teamPosition = "";
    $teamMan = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_team = $parsed_data[$index];
        $team_id = $single_team["TeamId"];
        $teamName = $single_team["Name"];
        $teamTotalTrop = $single_team["TotalTrophies"];
        $teamFD = $single_team["FoundedDate"];
        $teamCountry = $single_team["Country"];
        $teamValue = $single_team["Value"];
        $teamPosition = $single_team["position"];
        $teamMan = $single_team["ManagerId"];


        $team_record = array("TeamId" => $team_id, "Name" => $teamName, "TotalTrophies" => $teamTotalTrop, "FoundedDate" => $teamFD,
            "Country" => $teamCountry, "Value" => $teamValue, "position" => $teamPosition, "ManagerId" => $teamMan);
        $team_model->createTeam($team_record);
    }
    
    return $response->withStatus($response_code);
}

// Delete a given team
function handleDeleteTeam(Request $request, Response $response, array $args) {
    $team_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $team_id = $args["team_id"];
    
    $team_count = $team_model->getTeamById($team_id);
    if (!$team_count){
        $response_data = json_encode(getErrorNotFound());
        $response_code = HTTP_NOT_FOUND;
        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    } 

    if (isset($team_id)) {
        $team_model->deleteTeam($team_id);
    } 
    else {
        $response_data = makeCustomJSONError("resourceNotFound", "You must specify an team id!");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }    
    
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode("The team  $team_id was successfully deleted");
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdateTeam(Request $request, Response $response) {
    $team_model = new TeamModel();
    $parsed_data = $request->getParsedBody();

    $team_id = "";
    $teamName = "";
    $teamTotalTrop = "";
    $teamFD = "";
    $teamCountry = "";
    $teamValue = "";
    $teamPosition = "";
    $teamMan = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_team = $parsed_data[$index];
        $team_id = $single_team["TeamId"];
        $teamName = $single_team["Name"];
        $teamTotalTrop = $single_team["TotalTrophies"];
        $teamFD = $single_team["FoundedDate"];
        $teamCountry = $single_team["Country"];
        $teamValue = $single_team["Value"];
        $teamPosition = $single_team["position"];
        $teamMan = $single_team["ManagerId"];
        
        $team_record = array("Name" => $teamName, "TotalTrophies" => $teamTotalTrop, "FoundedDate" => $teamFD,
            "Country" => $teamCountry, "Value" => $teamValue, "position" => $teamPosition, "ManagerId" => $teamMan);
        $team_condition = array("TeamId" => $team_id);
        $team_model->updateTeam($team_record, $team_condition);
    }
    // $response->getBody()->write("The team was successfully updated\r\n Artist Id: ".$artist_id."\r\nName: ".$artistName);
    return $response;
}