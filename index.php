<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './includes/app_constants.php';
require_once './includes/helpers/helper_functions.php';
require_once './includes/helpers/Paginator.php';

//--Step 1) Instantiate App.
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

//-- Step 2) Add routing middleware.
$app->addRoutingMiddleware();
//-- Step 3) Add error handling middleware.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
//-- Step 4)
// TODO: change the name of the sub directory here. You also need to change it in .htaccess
$app->setBasePath("/football-api");

//-- Step 5) Include the files containing the definitions of the callbacks.
require_once './includes/routes/customers_routes.php';
require_once './includes/routes/teams_routes.php';
require_once './includes/routes/assists_routes.php';
require_once './includes/routes/cards_routes.php';
require_once './includes/routes/fixtures_routes.php';
require_once './includes/routes/goals_routes.php';
require_once './includes/routes/leagues_routes.php';
require_once './includes/routes/managers_routes.php';
require_once './includes/routes/participations_routes.php';
require_once './includes/routes/players_routes.php';
require_once './includes/routes/stadiums_routes.php';

$app->get("/teams", "handleGetAllTeams");
$app->get("/assists", "handleGetAllAssists");
$app->get("/cards", "handleGetAllCards");
$app->get("/fixtures", "handleGetAllFixtures");
$app->get("/goals", "handleGetAllGoals");
$app->get("/leagues", "handleGetAllLeagues");
$app->get("/managers", "handleGetAllManagers");
$app->get("/participations", "handleGetAllParticipations");
$app->get("/players", "handleGetAllPlayers");
$app->get("/stadiums", "handleGetAllStadiums");

$app->get("/players/{player_id}", "handleGetPlayerById");
$app->get("/players/{player_id}/goals", "handleGetGoalsFromPlayer");
$app->get("/players/{player_id}/cards", "handleGetCardsFromPlayer");
$app->get("/players/{player_id}/assists", "handleGetAssistsFromPlayer");
$app->get("/managers/{manager_id}", "handleGetManagerById");
$app->get("/managers/{manager_id}/teams", "handleGetTeamFromManager");
$app->get("/teams/{team_id}/fixtures", "handleGetFixturesFromTeam");
$app->get("/teams/{team_id}/stadiums", "handleGetStadiumFromTeam");
$app->get("/leagues/{league_id}", "handleGetLeagueById");
$app->get("/leagues/{league_id}/teams", "handleGetTeamsFromLeague");

$app->post("/teams", "handleCreateTeam");
$app->put("/teams", "handleUpdateTeam");
$app->get("/teams/{team_id}", "handleGetTeamById");
$app->delete("/teams/{team_id}", "handleDeleteTeam");

$app->post("/players", "handleCreatePlayer");
$app->delete("/players/{player_id}", "handleDeletePlayer");
$app->put("/players", "handleUpdatePlayer");

$app->post("/cards", "handleCreateCard");
$app->put("/cards", "handleUpdateCard");

$app->post("/assists", "handleCreateAssist");
$app->put("/assists", "handleUpdateAssist");


// Run the app.
$app->run();
