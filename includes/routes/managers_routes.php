<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ManagerModel.php';


function handleGetAllManagers(Request $request, Response $response, array $args) {
    $manager_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $manager_model = new ManagerModel();

    $manager_info = $manager_model->getAll();
        
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($manager_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetManagerById(Request $request, Response $response, array $args) {
    $manager_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $manager_model = new ManagerModel();

    $manager_id = $args["manager_id"];
    
    if (isset($manager_id)) {
        
        $manager_info = $manager_model->getManagerById($manager_id);
        if (!$manager_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Manager does not exist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($manager_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}