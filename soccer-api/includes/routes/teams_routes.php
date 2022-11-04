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