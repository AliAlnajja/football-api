<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ParticipationModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';


function handleGetAllParticipations(Request $request, Response $response, array $args) {
    $participation_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $participation_model = new ParticipationModel();

    $logging_model = new WSLoggingModel();
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfParticipation");

    $participation_info = $participation_model->getAll();
        
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($participation_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}