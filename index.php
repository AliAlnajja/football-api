<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//var_dump($_SERVER["REQUEST_METHOD"]);
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './includes/app_constants.php';
require_once './includes/helpers/helper_functions.php';
require_once './includes/helpers/Paginator.php';
require_once './includes/helpers/JWTManager.php';

define('APP_BASE_DIR', __DIR__);
// IMPORTANT: This file must be added to your .ignore file. 
define('APP_ENV_CONFIG', 'config.env');


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

$jwt_secret = JWTManager::getSecretKey();
$api_base_path = "/football-api";
$app->add(new Tuupola\Middleware\JwtAuthentication([
            'secret' => $jwt_secret,
            'algorithm' => 'HS256',
            'secure' => false, // only for localhost for prod and test env set true            
            "path" => $api_base_path, // the base path of the API
            "attribute" => "decoded_token_data",
            "ignore" => ["$api_base_path/token", "$api_base_path/account"],
            "error" => function ($response, $arguments) {
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                $response->getBody()->write(
                        json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
                );
                return $response->withHeader("Content-Type", "application/json;charset=utf-8");
            }
        ]));
        
//-- Step 5) Include the files containing the definitions of the callbacks.
require_once './includes/routes/token_routes.php';
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

$app->post("/token", "handleGetToken");
$app->post("/account", "handleCreateUserAccount");

$app->get("/playersAndPlayerInfo", "handleCompositeResource");
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

$app->post("/managers", "handleCreateManager");
$app->put("/managers", "handleUpdateManager");
$app->delete("/managers/{manager_id}", "handleDeleteManager");

$app->post("/leagues", "handleCreateLeague");
$app->delete("/leagues/{league_id}", "handleDeleteLeague");

$app->post("/goals", "handleCreateGoal");
$app->put("/goals", "handleUpdateGoal");

$app->post("/fixtures", "handleCreateFixture");
$app->put("/fixtures", "handleUpdateFixture");
$app->delete("/fixtures/{fixture_id}", "handleDeleteFixture");

$app->post("/assists", "handleCreateAssist");
$app->put("/assists", "handleUpdateAssist");

// Run the app.
$app->run();
