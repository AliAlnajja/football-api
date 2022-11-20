<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/PlayerModel.php';


function handleGetAllPlayers(Request $request, Response $response, array $args) {
    $player_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $player_model = new PlayerModel();

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

