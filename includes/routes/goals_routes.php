<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/GoalModel.php';


function handleGetAllGoals(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

    if($input_page_number === null && $input_per_page === null){
        $input_page_number = 1;
        $input_per_page = 10;
    }
    
    $goal_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $goal_model = new GoalModel();
    $goal_model->setPaginationOptions($input_page_number, $input_per_page);

    $filter_params = $request->getQueryParams();
    if(isset($filter_params["amount"])) {
        //get goals by amount
        $goal_info = $goal_model->getGoalsByAmount($filter_params["amount"]);
    }
    else {
        $goal_info = $goal_model->getAll();
    }
        
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($goal_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetGoalsFromPlayer(Request $request, Response $response, array $args) {
    $goal_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $goal_model = new GoalModel();

    $player_id = $args["player_id"];
    
    if (isset($player_id)) {
        
        $goal_info = $goal_model->getGoalsFromPlayer($player_id);
        if (!$goal_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Player has no goal info.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($goal_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Create
function handleCreateGoal(Request $request, Response $response,  array $args) {
    $goal_model = new GoalModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_goal = $parsed_data[$index];

        if($goal_model->getGoalsById($single_goal["GoalId"])){
            $response_data = makeCustomJSONError("Error", "The specific goal is already existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $goal_id = $single_goal["GoalId"];
        $player_id = $single_goal["PlayerId"];
        $goalAmount = $single_goal["Amount"];


        $goal_record = array(
            "GoalId" => $goal_id, 
            "PlayerId" => $player_id, 
            "Amount " => $goalAmount 
        );


        $query_result = $goal_model->createGoal($goal_record);
        if ($query_result != 0) {
            $response_data = makeCustomJSONError("Error", "Input Goal can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessCreated());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Update
function handleUpdateGoal(Request $request, Response $response,  array $args) {
    $goal_model = new GoalModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_goal = $parsed_data[$index];

        if(!$goal_model->getGoalsById($single_goal["GoalId"])){
            $response_data = makeCustomJSONError("Error", "The specific goal do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $goal_id = $single_goal["GoalId"];
        $player_id = $single_goal["PlayerId"];
        $goalAmount = $single_goal["Amount"];


        $goal_record = array(
            "PlayerId" => $player_id, 
            "Amount " => $goalAmount 
        );

        $query_condition = array("GoalId" => $goal_id);
        $query_result = $goal_model->updateGoal($goal_record, $query_condition);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "Input Goal can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}