<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './includes/app_constants.php';
require_once './includes/helpers/helper_functions.php';

//--Step 1) Instantiate App.
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

//-- Step 2) Add routing middleware.
$app->addRoutingMiddleware();
//-- Step 3) Add error handling middleware.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
//-- Step 4)
// TODO: change the name of the sub directory here. You also need to change it in .htaccess
$app->setBasePath("/soccer-api");

//-- Step 5) Include the files containing the definitions of the callbacks.
require_once './includes/routes/artists_routes.php';
require_once './includes/routes/customers_routes.php';
require_once './includes/routes/teams_routes.php';



$app->get("/teams", "handleGetAllTeams");


// $app->get("/artists", "handleGetAllArtists");
// $app->get("/artists/{artist_id}", "handleGetArtistById");
// $app->get("/artists/{artist_id}/albums", "handleGetAlbumsByArtist");
// $app->get("/artists/{artist_id}/albums/{album_id}/tracks", "handleGetSpecificTracks");
// $app->post("/artists", "handleCreateArtist");
// $app->put("/artists", "handleUpdateArtist");
// $app->delete("/artists/{artist_id}", "handleDeleteArtist");

// customer callbacks (4)
// $app->get("/customers/{customer_id}/invoices", "handleGetTracksPurchased");
// $app->get("/customers", "handleGetAllCustomers");
// $app->delete("/customers/{customer_id}", "handleDeleteCustomer");

// Run the app.
$app->run();
