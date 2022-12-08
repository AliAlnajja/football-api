<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ManagerModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';


function handleGetAllManagers(Request $request, Response $response, array $args) {
    $manager_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $manager_model = new ManagerModel();

    $logging_model = new WSLoggingModel();
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfManagers");
    
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["contract"])) {
        //get managers by contract
        $manager_info = $manager_model->getManagersByContract($filter_params["contract"]);
    } else {
        $manager_info = $manager_model->getAll();
    }  
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

//Create
function handleCreateManager(Request $request, Response $response,  array $args) {
    $manager_model = new ManagerModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_manager = $parsed_data[$index];

        if($manager_model->getManagerById($single_manager["ManagerId"])){
            $response_data = makeCustomJSONError("Error", "The specific manager is already existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $manager_id = $single_manager["ManagerId"];
        $managerName = $single_manager["Name"];
        $managerAge = $single_manager["Age"];
        $managerContract = $single_manager["contract"];
        $managerTrophyCabinet = $single_manager["TrophyCabinet"];
        $managerNumExp = $single_manager["NumExp"];
        $teamId = $single_manager["TeamId"];


        $manager_record = array(
            "ManagerId" => $manager_id, 
            "Name" => $managerName, 
            "Age" => $managerAge, 
            "contract" => $managerContract,
            "TrophyCabinet" => $managerTrophyCabinet, 
            "NumExp" => $managerNumExp, 
            "TeamId" => $teamId);


        $query_result = $manager_model->createManager($manager_record);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "Input Manager can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessCreated());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Update
function handleUpdateManager(Request $request, Response $response,  array $args) {
    $manager_model = new ManagerModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_manager = $parsed_data[$index];

        if(!$manager_model->getManagerById($single_manager["ManagerId"])){
            $response_data = makeCustomJSONError("Error", "The specific manager do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $managerName = $single_manager["Name"];
        $managerAge = $single_manager["Age"];
        $managerContract = $single_manager["contract"];
        $managerTrophyCabinet = $single_manager["TrophyCabinet"];
        $managerNumExp = $single_manager["NumExp"];
        $teamId = $single_manager["TeamId"];


        $manager_record = array(
            "Name" => $managerName, 
            "Age" => $managerAge, 
            "contract" => $managerContract,
            "TrophyCabinet" => $managerTrophyCabinet, 
            "NumExp" => $managerNumExp, 
            "TeamId" => $teamId);

        $query_condition = array("ManagerId" => $single_manager["ManagerId"]);    
        $query_result = $manager_model->updateManager($manager_record, $query_condition);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "Input Manager can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Delete
function handleDeleteManager(Request $request, Response $response,  array $args) {
    $manager_model = new ManagerModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_OK;
    $manager_id = $args["manager_id"];

    if(isset($manager_id)){
        if(!$manager_model->getManagerById($manager_id)){
            $response_data = makeCustomJSONError("Error", "The specific manager do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $query_result = $manager_model->deleteManager($manager_id);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "The specific manager can not be delete");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessDelete());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

