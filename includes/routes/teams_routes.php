<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/TeamModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';


function handleGetAllTeams(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);
    // Instantiate the model.
    // Set the pagination options.
    $logging_model = new WSLoggingModel();
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfTeams");

    if($input_page_number === null && $input_per_page === null){
        $input_page_number = 1;
        $input_per_page = 10;
    }
    $team_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();
    $team_model->setPaginationOptions($input_page_number, $input_per_page);

    $filter_params = $request->getQueryParams();
    if(isset($filter_params["name"])) {
        //get teams by name
        $team_info = $team_model->getTeamsByName($filter_params["name"]);
    }
    else if(isset($filter_params["trophies"])) {
        //get teams by trophies
        $team_info = $team_model->getTeamsByTotalTrophies($filter_params["trophies"]);
    }
    else {
        $team_info = $team_model->getAll();
    }

    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($team_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetTeamFromManager(Request $request, Response $response, array $args) {
    $team_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $manager_id = $args["manager_id"];
    
    if (isset($manager_id)) {
        
        $team_info = $team_model->getTeamFromManager($manager_id);
        if (!$team_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Invalid Manager Id.");
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


function handleGetTeamById(Request $request, Response $response, array $args) {
    $team_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $team_id = $args["team_id"];
    
    if (isset($team_id)) {
        
        $team_info = $team_model->getTeamById($team_id);
        if (!$team_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Team does not exist.");
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

function handleGetTeamsFromLeague(Request $request, Response $response, array $args) {
    $team_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $league_id = $args["league_id"];
    
    if (isset($league_id)) {
        
        $team_info = $team_model->getTeamsFromLeague($league_id);
        if (!$team_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "League has no teams.");
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
    $table = "teams";

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
        $teamLeague = $single_team["LeagueId"];

        $team_record = array("TeamId" => $team_id, "Name" => $teamName, "TotalTrophies" => $teamTotalTrop, "FoundedDate" => $teamFD,
            "Country" => $teamCountry, "Value" => $teamValue, "position" => $teamPosition, "ManagerId" => $teamMan, "LeagueId" => $teamLeague);

        $team_model->create($table, $team_record);
    }

    if($response_code === HTTP_CREATED){
        $response_data = json_encode(getSuccessCreated());
    }
    
    $response->getBody()->write($response_data);
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
        $response_data = json_encode(getSuccessDelete());
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdateTeam(Request $request, Response $response) {
    $team_model = new TeamModel();
    $response_data = array();
    $response_code = HTTP_OK;
    $parsed_data = $request->getParsedBody();
    $table = "teams";

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
        $teamLeague = $single_team["LeagueId"];

        $team_record = array("Name" => $teamName, "TotalTrophies" => $teamTotalTrop, "FoundedDate" => $teamFD,
            "Country" => $teamCountry, "Value" => $teamValue, "position" => $teamPosition, "ManagerId" => $teamMan, "LeagueId" => $teamLeague);

        $team_condition = array("TeamId" => $team_id);
        $team_model->updateTable($table, $team_record, $team_condition);
    }
    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response;
}



