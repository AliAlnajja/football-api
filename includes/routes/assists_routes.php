<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/AssistModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';


function handleGetAllAssists(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

    $logging_model = new WSLoggingModel();
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfAssists");

    if($input_page_number === null && $input_per_page === null){
        $input_page_number = 1;
        $input_per_page = 10;
    }

    $assist_info = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $assist_model = new AssistModel();
    $assist_model->setPaginationOptions($input_page_number, $input_per_page);


    $assist_info = $assist_model->getAll();
        
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($assist_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetAssistsFromPlayer(Request $request, Response $response, array $args) {
    $assist_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $assist_model = new AssistModel();

    $player_id = $args["player_id"];
    
    if (isset($player_id)) {
        
        $assist_info = $assist_model->getAssistsFromPlayer($player_id);
        if (!$assist_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Player has no assist info.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($assist_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Create
function handleCreateAssist(Request $request, Response $response,  array $args) {
    $assist_model = new AssistModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_assist = $parsed_data[$index];

        if($assist_model->getAssistsById($single_assist["AssistId"])){
            $response_data = makeCustomJSONError("Error", "The specific assist is already existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $assist_id = $single_assist["AssistId"];
        $player_id = $single_assist["PlayerId"];
        $assistAmount = $single_assist["Amount"];


        $assist_record = array(
            "AssistId" => $assist_id, 
            "PlayerId" => $player_id, 
            "Amount " => $assistAmount 
        );


        $query_result = $assist_model->createAssist($assist_record);
        if ($query_result != 0) {
            $response_data = makeCustomJSONError("Error", "Input Assist can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessCreated());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Update
function handleUpdateAssist(Request $request, Response $response,  array $args) {
    $assist_model = new AssistModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_assist = $parsed_data[$index];

        if(!$assist_model->getAssistsById($single_assist["AssistId"])){
            $response_data = makeCustomJSONError("Error", "The specific assist do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $assist_id = $single_assist["AssistId"];
        $player_id = $single_assist["PlayerId"];
        $assistAmount = $single_assist["Amount"];


        $assist_record = array(
            "PlayerId" => $player_id, 
            "Amount " => $assistAmount 
        );

        $query_condition = array("AssistId" => $assist_id);
        $query_result = $assist_model->updateAssist($assist_record, $query_condition);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "Input Assist can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}
