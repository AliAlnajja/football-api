<?php

/**
 * Returns an error name and message for the unsupported format
 */
function getErrorUnsupportedFormat() {
    $error_data = array(
        "error:" => "unsuportedResponseFormat",
        "message:" => "The requested resouce representation is available only in JSON."
    );
    return $error_data;
}

/**
 * Returns an error name and message if the id of the resource does not exists
 */
function getErrorNotFound() {
    $error_data = array(
        "error:" => "Not Found",
        "message:" => "The requested id does not exist"
    );
    return $error_data;
}

/**
 * Returns an error name and message if the id of the resource does not exists
 */
function getSuccessCreated() {
    $error_data = array(
        "error:" => "Created",
        "message:" => "The request was successfully created"
    );
    return $error_data;
}

/**
 * Returns an error if the code is not in an Json format
 */
function makeCustomJSONError($error_code, $error_message) {
    $error_data = array(
        "error:" => $error_code,
        "message:" => $error_message
    );    
    return json_encode($error_data);
}