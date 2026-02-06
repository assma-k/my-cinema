<?php
require("autoload.php");

$db = new Databases();
$pdo = $db->Connexion();

$url = $_GET["url"] ?? "/";
$router = new router($url, $pdo);
$router->get("/movie", "movieController@index");
$router->get("/movie/:id", "movieController@show");
$router->post("/movie/add/", "movieController@add");
$router->post("/movie/update/:id", "movieController@update");
$router->get("/movie/delete/:id", "movieController@delete");

$router->get("/rooms", "roomController@index");
$router->post("/room/add", "roomController@store");
$router->post("/room/update/:id", "roomController@update");
$router->get("/room/delete/:id", "roomController@delete");

$router->get("/screenings", "screeningController@index");
$router->post("/screening/add", "screeningController@store");
$router->post("/screening/update/:id", "screeningController@update");
$router->get("/screening/delete/:id", "screeningController@delete");
$router->run();