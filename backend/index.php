<?php
require_once("Config/database.php");
require_once("Model/movie.php");

$base = new Databases();
$db= $base->Connexion();

$movie = new movie($db);
$fil=$movie->film(1);
echo "<pre>";
print_r($fil);
echo "</pre>";