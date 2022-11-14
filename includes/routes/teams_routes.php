<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/TeamModel.php';


function handleGetAllTeams(Request $request, Response $response, array $args) {
    $team_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $team_model = new TeamModel();

    $team_info = $team_model->getAll();
        
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