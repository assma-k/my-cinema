<?php
require("autoload.php");

$base = new Databases();
$db= $base->Connexion();
$movie = new movieRepository($db);

$fil=$movie->idFilm(1);
header('Content-Type: application/json');
echo json_encode($fil);

//add movie

//$nouveauFilm = new movie();
//$nouveauFilm->setTitle("Inception");
//$nouveauFilm->setDescription("Dom Cobb est un extracteur...");
//$nouveauFilm->setDuration(148);
//$nouveauFilm->setReleaseYear(2010);
//$nouveauFilm->setGenre("Science-Fiction");
//$nouveauFilm->setDirector("Christopher Nolan");

//$movie->addMovie($nouveauFilm);

//echo "Le film a été enregistré avec l'ID : " . $nouveauFilm->getId();

// upload movie

//$filmAModifier = $movie->idFilm(7);

//$filmAModifier->setTitle("Nouveau Titre Trop Cool");

//$movie->uploadMovie($filmAModifier);


// delete movie 

$idASupprimer = 7;

$film = $movie->idFilm($idASupprimer);

if ($film) {
    $success = $movie->deleteMovie($film);
    
    if ($success) {
        echo json_encode(["message" => "Le film a bien été supprimé."]);
    } else {
        echo json_encode(["message" => "Erreur lors de la suppression."]);
    }
} else {
    echo json_encode(["message" => "Ce film n'existe pas."]);
}
