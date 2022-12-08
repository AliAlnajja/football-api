<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/FixtureModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';


function handleGetAllFixtures(Request $request, Response $response, array $args) {
    $fixture_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $fixture_model = new FixtureModel();

    $logging_model = new WSLoggingModel();
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfFixtures");
        
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["weather"])) {
        // get fixtures by weather
        $fixture_info = $fixture_model->getFixturesByWeather($filter_params["weather"]);
    } else {
        $fixture_info = $fixture_model->getAll();
    }  
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($fixture_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetFixturesFromTeam(Request $request, Response $response, array $args) {
    $fixture_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $fixture_model = new FixtureModel();

    $team_id = $args["team_id"];
    
    if (isset($team_id)) {
        
        $fixture_info = $fixture_model->getFixturesFromTeam($team_id);
        if (!$fixture_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Team has no fixture info.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($fixture_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Create
function handleCreateFixture(Request $request, Response $response,  array $args) {
    $fixture_model = new FixtureModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_fixture = $parsed_data[$index];

        if($fixture_model->getFixtureById($single_fixture["FixtureId"])){
            $response_data = makeCustomJSONError("Error", "The specific fixture is already existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }


        $fixture_id = $single_fixture["FixtureId"];
        $teamId = $single_fixture["TeamId"];
        $fixtureWeather_Cond = $single_fixture["Weather_Cond"];
        $fixtureDate = $single_fixture["Date"];
        
        $fixture_record = array(
            "FixtureId" => $fixture_id,
            "TeamId" => $teamId, 
            "Weather_Cond" => $fixtureWeather_Cond, 
            "Date" => $fixtureDate
        );

        $query_result = $fixture_model->createFixture($fixture_record);
        if ($query_result != 0) {
            $response_data = makeCustomJSONError("Error", "Input Fixture can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessCreated());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Update
function handleUpdateFixture(Request $request, Response $response,  array $args) {
    $fixture_model = new FixtureModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_fixture = $parsed_data[$index];

        if(!$fixture_model->getFixtureById($single_fixture["FixtureId"])){
            $response_data = makeCustomJSONError("Error", "The specific fixture do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $teamId = $single_fixture["TeamId"];
        $fixtureWeather_Cond = $single_fixture["Weather_Cond"];
        $fixtureDate = $single_fixture["Date"];
        
        $fixture_record = array(
            "TeamId" => $teamId, 
            "Weather_Cond" => $fixtureWeather_Cond, 
            "Date" => $fixtureDate
            );

        $query_condition = array("FixtureId" => $single_fixture["FixtureId"]);    
        $query_result = $fixture_model->updateFixture($fixture_record, $query_condition);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "Input Fixture can not be created");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

//Delete
function handleDeleteFixture(Request $request, Response $response,  array $args) {
    $fixture_model = new FixtureModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_OK;
    $fixture_id = $args["fixture_id"];

    if(isset($fixture_id)){
        if(!$fixture_model->getFixtureById($fixture_id)){
            $response_data = makeCustomJSONError("Error", "The specific fixture do not existed");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }

        $query_result = $fixture_model->deleteFixture($fixture_id);
        if (!$query_result) {
            $response_data = makeCustomJSONError("Error", "The specific fixture can not be delete");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_METHOD_NOT_ALLOWED);
        }
    }

    $response_data = json_encode(getSuccessDelete());
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

