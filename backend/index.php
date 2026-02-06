<?php
require("autoload.php");

$db = new Databases();
$pdo = $db->Connexion();

$url = $_GET["url"] ?? "/";
$router = new router($_GET[$url]);
$router->get("/movie", "movieController@index");
$router->get("/movie/:id", "MovieController@show");
$router->post("/movie/update/:id", "MovieController@update");
$router->get("/movie/delete/:id", "MovieController@delete");

$router->get("/rooms", "RoomController@index");
$router->post("/room/add", "RoomController@store");
$router->post("/room/update/:id", "RoomController@update");
$router->get("/room/delete/:id", "RoomController@delete");

$router->get("/screenings", "ScreeningController@index");
$router->post("/screening/add", "ScreeningController@store");
$router->post("/screening/update/:id", "ScreeningController@update");
$router->get("/screening/delete/:id", "ScreeningController@delete");
$router->run();