<?php
require("autoload.php");

$db = new Databases();
$pdo = $db->Connexion();

$url = $_SERVER["PATH_INFO"] ?? $_GET["url"] ?? "/";
error_log("URL reçue : " . $url);
error_log("PATH_INFO : " . ($_SERVER["PATH_INFO"] ?? "vide"));
error_log("GET url : " . ($_GET["url"] ?? "vide"));

$router = new router($url, $pdo);
$router->get("/movie", "movieController@index");
$router->get("/movie/:id", "movieController@show");
$router->post("/movie/add/", "movieController@add");
$router->post("/movie/update/:id", "movieController@update");
$router->get("/movie/delete/:id", "movieController@delete");

$router->get("/rooms", "roomController@index");
$router->post("/room/add", "roomController@add");
$router->get("/room/:id", "roomController@show");
$router->post("/room/update/:id", "roomController@update");
$router->get("/room/delete/:id", "roomController@delete");

$router->get("/screenings", "screeningController@index");
$router->get("/screenings/:id", "screeningController@show");
$router->post("/screening/add", "screeningController@add");
$router->post("/screening/update/:id", "screeningController@update");
$router->get("/screening/delete/:id", "screeningController@delete");
$router->run();