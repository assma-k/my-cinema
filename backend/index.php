<?php
require("autoload.php");

$base = new Databases();
$db= $base->Connexion();
$movie = new movieRepository($db);

$fil=$movie->idFilm(1);
echo json_encode($fil);


//$add=$movie->addMovie("Interstellar", "Une équipe d'explorateurs voyage...", 169, 2014, "Drame / SF", "Christopher Nolan");
//$film=$movie->film();
//echo "<pre>";
//print_r($film);
//echo "</pre>";

//$movie->deleteMovie(6);
//$film = $movie->film();
//echo "<pre>";
//print_r($film);
//echo "</pre>";

//$movie->uploadMovie("Inception - Version Longue", "Un film sur les rêves", 180, 2010, "SF", "Christopher Nolan", 1);
//$li = $movie->film();
//echo "<pre>";
//print_r($li);
//echo "</pre>";

