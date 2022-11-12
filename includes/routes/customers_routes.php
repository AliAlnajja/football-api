<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/CustomerModel.php';

// Get the list of all customers
// Get the list of all customers with specific country 
function handleGetAllCustomers(Request $request, Response $response) {
    //Creating array to store customer info
    $customer_info = array();
    
    //Creating array to store customer info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $customer_model = new CustomerModel();
    
    // Retrieving the country from the specified filters
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["Country"])){
        //Fetching all customer info with specified country
        $customer_info = $customer_model->getByCountry($filter_params["Country"]);
    } else {
        //Fetching all customer info
        $customer_info += $customer_model->getAllCustomers();
    }
    
    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($customer_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Get the list of all tracks purchased by a given customer
function handleGetTracksPurchased(Request $request, Response $response, array $args){
    //Creating array to store track info
    $track_info = array();
    
    //Creating array to store track info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $customer_model = new CustomerModel();

    // Retreiving the customer id from the request's URI.
    $customer_id = $args["customer_id"];
    // Validating customer id
    
    if (isset($customer_id)) {
        // Fetching the track info about the specified customer.
        $track_info = $customer_model->getTracksPurchased($customer_id);
        if (!$customer_id) {
            // If no matches found
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the tracks purchased by the specified customer");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($track_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Delete a specific customer
function handleDeleteCustomer(Request $request, Response $response, array $args) {
    //Creating array to store customer info
    $customer_info = array();
    
    //Creating array to store customer info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $customer_model = new CustomerModel();

    // Retreiving the customer id from the request's URI.
    $customer_id = $args["customer_id"];
   
    //Checks if the id exists
    $customer_count = $customer_model->getCustomerId($customer_id);
    if (!$customer_count){
        // No customer id detected.

        $response_data = json_encode(getErrorNotFound());
        $response_code = HTTP_NOT_FOUND;
        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    }  
    // Validating customer id
    if (isset($customer_id)) {
        // Removing the customer info about the specified customer.
        $customer_info = $customer_model->deleteCustomer($customer_id);
    } else {
        // If no artist id mentioned
        $response_data = makeCustomJSONError("resourceNotFound", "You must specify an customer id!");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    } 

    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode("The delete was done successfuly");
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}