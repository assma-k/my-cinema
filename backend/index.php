<?php
require_once("Config/database.php");
require_once("Model/movie.php");

$base = new Databases();
$db= $base->Connexion();

$movie = new movie($db);
$fil=$movie->idFilm(1);
echo "<pre>";
print_r($fil);
echo "</pre>";

$add=$movie->addMovie("Interstellar", "Une équipe d'explorateurs voyage...", 169, 2014, "Drame / SF", "Christopher Nolan");
$film=$movie->film();
echo "<pre>";
print_r($film);
echo "</pre>";