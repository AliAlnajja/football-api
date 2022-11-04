<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ArtistModel.php';


// Get all artists
function handleGetAllArtists(Request $request, Response $response) {
    //Creating array to store artist info
    $artist_info = array();
    
    //Creating array to store artist info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    //Fetching all customer info
    $artist_info += $artist_model->getAll();
        
   //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($artist_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Get the details of a given artists
function handleGetArtistById(Request $request, Response $response, array $args) {
    //Creating array to store artist info
    $artist_info = array();
    
    //Creating array to store artist info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    // Retreiving the artist id from the request's URI.
    $artist_id = $args["artist_id"];
    
    // Validating artist id
    if (isset($artist_id)) {
        // Fetching the artist info about the specified artist.
        $artist_info = $artist_model->getArtistById($artist_id);
        if (!$artist_info) {
            // If no matches found
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified artist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($artist_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Get the list of albums of a given artists
function handleGetAlbumsByArtist(Request $request, Response $response, array $args){
    //Creating array to store album info
    $album_info = array();
    
    //Creating array to store album info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    // Retreiving the artist id from the request's URI.
    $artist_id = $args["artist_id"];
    
    // Validating artist id
    if (isset($artist_id)) {
        // Fetching the album info about the specified artist.
        $album_info = $artist_model->getAlbumsByArtists($artist_id);
        if (!$album_info) {
            // If no matches found
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the album with the specified artist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    
    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode($album_info);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Get the list of tracks for the specified album and artist
// Filter tracks by genre and (or) media type.
function handleGetSpecificTracks(Request $request, Response $response, array $args){
    // Creating array to store track info
    $track_info = array();
    
    // Creating array to store track info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    // Storing arguments
    $artist_id = $args["artist_id"];
    $album_id = $args["album_id"];
    
    // Retrieving the GenreName and MediaTypeName from the specified filters
    $filter_params = $request->getQueryParams();
    
    
    if (isset($artist_id) && isset($album_id) && isset($filter_params)) {
        // If filter by GenreName
        if (isset($filter_params["GenreName"]) && !isset($filter_params["MediaTypeName"])) {
            // Fetch the info about the specified tracks.
            $track_info = $artist_model->getTrackByGenre($artist_id, $album_id, $filter_params["GenreName"]);
            
            // If no results found, return an error
            if (!$track_info) {
                $response_data = json_encode(getErrorNotFound());
                $response_code = HTTP_NOT_FOUND;
                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
        } 
        // If filter by MediaTypeName
        else if (isset($filter_params["MediaTypeName"]) && !isset($filter_params["GenreName"])) {
            // Fetch the info about the specified tracks.
            $track_info = $artist_model->getTrackByMediaType($artist_id, $album_id, $filter_params["MediaTypeName"]);
           
            // If no results found, return an error
            if (!$track_info) {
                $response_data = json_encode(getErrorNotFound());
                $response_code = HTTP_NOT_FOUND;
                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
        } 
        // If filter by GenreName and MediaType
        else if (isset($filter_params["GenreName"]) && isset($filter_params["MediaTypeName"])) {
            // Fetch the info about the specified tracks.
            $track_info = $artist_model->getTrackByGenreAndMediaType($artist_id, $album_id, $filter_params["GenreName"], $filter_params["MediaTypeName"]);
            
            // If no results found, return an error
            if (!$track_info) {
                $response_data = json_encode(getErrorNotFound());
                $response_code = HTTP_NOT_FOUND;
                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
        } 
        // If specified artist and album 
        else if (isset($artist_id) && isset($album_id) && !isset($filter_params["GenreName"]) && !isset($filter_params["MediaTypeName"])) {
             // Fetch the info about the track with specified artist and album.
            $track_info = $artist_model->getSpecificTracks($artist_id, $album_id);
            
            // If no results found, return an error
            if (!$track_info) {
                $response_data = json_encode(getErrorNotFound());
                $response_code = HTTP_NOT_FOUND;
                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
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

// Create one or more artists
function handleCreateArtist(Request $request, Response $response) {
    $artist_model = new ArtistModel();
    $parsed_data = $request->getParsedBody();
    $response_code = HTTP_CREATED;

    // Creating variables to temporarily store the attributes of the objects
    $artist_id = "";
    $artistName = "";
    
    // Creating a for loop that goes through the JSON content and that creates 
    // a new artist every time with the specified id and name
    for ($index = 0; $index < count($parsed_data); $index++){
        $single_artist = $parsed_data[$index];
        $artist_id = $single_artist["ArtistId"];
        $artistName = $single_artist["Name"];
        $artist_record = array("ArtistId" => $artist_id, "Name" => $artistName);
        $artist_model->createArtist($artist_record);
    }
    
    // Returning response
    $response->getBody()->write("The Artist was created successfully \r\n Artist Id: ".$artist_id."\r\nName: ".$artistName);
    return $response->withStatus($response_code);
}

function handleUpdateArtist(Request $request, Response $response) {
    $artist_model = new ArtistModel();
    $parsed_data = $request->getParsedBody();

    // create for loop that goes until length of data find values of keys 
    //    $data_string = "";
    $artist_id = "";
    $artistName = "";
    for ($index = 0; $index < count($parsed_data); $index++){
        $single_artist = $parsed_data[$index];
        $artist_id = $single_artist["ArtistId"];
        $artistName = $single_artist["Name"];
        $artist_record = array("Name" => $artistName);
        $artist_condition = array("ArtistId" => $artist_id);
        $artist_model->updateArtist($artist_record, $artist_condition);
    }
    $response->getBody()->write("The Artist was successfully updated\r\n Artist Id: ".$artist_id."\r\nName: ".$artistName);
    return $response;
}

// Delete a given artist
function handleDeleteArtist(Request $request, Response $response, array $args) {
    // Creating array to store artist info
    $artist_info = array();
    
    // Creating array to store artist info in JSON representation
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    // Retreiving the artist id from the request's URI.
    $artist_id = $args["artist_id"];
    
    //Checks if the id exists
    $artist_count = $artist_model->getArtistById($artist_id);
    if (!$artist_count){
        // No artist id detected.
        $response_data = json_encode(getErrorNotFound());
        $response_code = HTTP_NOT_FOUND;
        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    } 

    // Validating artist id
    if (isset($artist_id)) {
        // Removing the artist with the specified artist id.
        $artist_model->deleteArtist($artist_id);
    } 
    else {
        // If no artist id mentioned
        $response_data = makeCustomJSONError("resourceNotFound", "You must specify an artist id!");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }    
    
    //Validating JSON Accept representation 
    $requested_format = $request->getHeader('Accept');  
    if ($requested_format[0] === "application/json") {
        $response_data = json_encode("The artist  $artist_id was successfully deleted");
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    
    // Returning response 
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}