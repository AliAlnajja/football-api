<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/AssistModel.php';


function handleGetAllAssists(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

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

function handleCreateAssist(Request $request, Response $response) {
    $assist_model = new AssistModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;
    $table = "assist";

    $AssistId = "";
    $PlayerId = "";
    $Amount = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_assist = $parsed_data[$index];
        $AssistId = $single_assist["AssistId"];
        $PlayerId = $single_assist["PlayerId"];
        $Amount = $single_assist["Amount"];

        $assist_record = array("AssistId" => $AssistId, "PlayerId" => $PlayerId, "Amount" => $Amount);

        $assist_model->create($table, $assist_record);
    }

    if($response_code === HTTP_CREATED){
        $response_data = json_encode(getSuccessCreated());
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdateAssist(Request $request, Response $response) {
    $assist_model = new AssistModel();
    $response_data = array();
    $response_code = HTTP_OK;
    $parsed_data = $request->getParsedBody();
    $table = "assist";

    $AssistId = "";
    $PlayerId = "";
    $Amount = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_assist = $parsed_data[$index];
        $AssistId = $single_assist["AssistId"];
        $PlayerId = $single_assist["PlayerId"];
        $Amount = $single_assist["Amount"];

        $assist_record = array( "PlayerId" => $PlayerId, "Amount" => $Amount);


        $assist_condition = array("AssistId" => $AssistId,);
        $assist_model->updateTable($table, $assist_record, $assist_condition);
    }
    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response;
}