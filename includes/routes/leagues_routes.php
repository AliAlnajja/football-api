<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/LeagueModel.php';


function handleGetAllLeagues(Request $request, Response $response, array $args) {
    $league_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $league_model = new LeagueModel();

    $league_info = $league_model->getAll();
        
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($league_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetLeagueById(Request $request, Response $response, array $args) {
    $league_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $league_model = new LeagueModel();

    $league_id = $args["league_id"];
    
    if (isset($league_id)) {
        
        $league_info = $league_model->getLeagueById($league_id);
        if (!$league_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "League does not exist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($league_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Create
function handleCreateLeague(Request $request, Response $response,  array $args) {
    $league_model = new LeagueModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_league = $parsed_data[$index];

        if($league_model->getLeagueById($single_league["LeagueId"])){
            $response_data = makeCustomJSONError("Error", "The specific league is already existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $league_id = $single_league["LeagueId"];
        $leagueName = $single_league["Name"];
        $leagueCountry = $single_league["Country"];


        $league_record = array(
            "LeagueId" => $league_id, 
            "Name" => $leagueName, 
            "Country " => $leagueCountry 
        );


        $query_result = $league_model->createLeague($league_record);
        if ($query_result != 0) {
            $response_data = makeCustomJSONError("Error", "Input League can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessCreated());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Delete
function handleDeleteLeague(Request $request, Response $response,  array $args) {
    $league_model = new LeagueModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_OK;
    $league_id = $args["league_id"];

    if(isset($league_id)){
        if(!$league_model->getLeagueById($league_id)){
            $response_data = makeCustomJSONError("Error", "The specific league do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $query_result = $league_model->deleteLeague($league_id);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "The specific league can not be delete");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessDelete());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}