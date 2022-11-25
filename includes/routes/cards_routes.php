<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/CardModel.php';


function handleGetAllCards(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

    if($input_page_number === null && $input_per_page === null){
        $input_page_number = 1;
        $input_per_page = 10;
    }
    
    $card_info = array();
    
    $response_data = array();
    $response_code = HTTP_OK;
    $card_model = new CardModel();
    $card_model->setPaginationOptions($input_page_number, $input_per_page);
    
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["type"])) {
        // get cards by type
        $card_info = $card_model->getCardsByType($filter_params["type"]);
    } else {
        $card_info = $card_model->getAll();
    }  
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($card_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetCardsFromPlayer(Request $request, Response $response, array $args) {
    $card_info = array();

    $response_data = array();
    $response_code = HTTP_OK;
    $card_model = new CardModel();

    $player_id = $args["player_id"];
    
    if (isset($player_id)) {
        
        $card_info = $card_model->getCardsFromPlayer($player_id);
        if (!$card_info) {
            
            $response_data = makeCustomJSONError("resourceNotFound", "Player has no card info.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
     
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($card_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleCreateCard(Request $request, Response $response) {
    $card_model = new CardModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    $CardId = "";
    $PlayerId = "";
    $Total = "";
    $CardType = "";


    for ($index = 0; $index < count($parsed_data); $index++){
        $single_card = $parsed_data[$index];
        $CardId = $single_card["CardId"];
        $PlayerId = $single_card["PlayerId"];
        $Total = $single_card["Total"];
        $CardType = $single_card["CardType"];

        $card_record = array("CardId" => $CardId, "PlayerId" => $PlayerId, "Total" => $Total, "CardType" => $CardType);

        $card_model->createCard($card_record);
    }

    if($response_code === HTTP_CREATED){
        $response_data = json_encode(getSuccessCreated());
    }
    
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdateCard(Request $request, Response $response) {
    $card_model = new CardModel();
    $response_data = array();
    $response_code = HTTP_OK;
    $parsed_data = $request->getParsedBody();

    $CardId = "";
    $PlayerId = "";
    $Total = "";
    $CardType = "";

    for ($index = 0; $index < count($parsed_data); $index++){
        $single_card = $parsed_data[$index];
        $CardId = $single_card["CardId"];
        $PlayerId = $single_card["PlayerId"];
        $Total = $single_card["Total"];
        $CardType = $single_card["CardType"];

        $card_record = array("PlayerId" => $PlayerId, "Total" => $Total, "CardType" => $CardType);

        $card_condition = array("CardId" => $CardId);
        $card_model->updateCard($card_record, $card_condition);
    }
    $response_data = json_encode(getSuccessUpdate());
    $response->getBody()->write($response_data);
    return $response;
}