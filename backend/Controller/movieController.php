<?php
class movieController
{
    private $db;

    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function index()
    {
        $repo = new movieRepository($this->db);
        $movies = $repo->film();

        header('Content-Type: application/json');
        echo json_encode($movies);
    }

    public function show($id)
    {
        $repo = new movieRepository($this->db);
        $movie = $repo->idFilm($id);
        header('Content-Type: application/json');
        if ($movie->getId()) {
            echo json_encode($movie);
        } else {
            http_response_code(404);
        }
    }

    public function add($m)
    {
        $data = json_decode(file_get_contents('php://input'));
        $m = new movie();
        $m->setTitle($data->title);
        $m->setDescription($data->description);
        $m->setDuration($data->duration);
        $m->setReleaseYear($data->release_year);
        $m->setGenre($data->genre);
        $m->setDirector($data->director);
        $repo = new movieRepository($this->db);
        $repo->addMovie($m);
        header('Content-Type: application/json');
        echo json_encode($m);
    }

    public function update($id){
         $data = json_decode(file_get_contents('php://input'));
        $m = new movie();
        $m->setId($id);
        $m->setTitle($data->title);
        $m->setDescription($data->description);
        $m->setDuration($data->duration);
        $m->setReleaseYear($data->release_year);
        $m->setGenre($data->genre);
        $m->setDirector($data->director);
        $repo = new movieRepository($this->db);
        $repo->uploadMovie($m);
        header('Content-Type: application/json');
        echo json_encode($m);
    }
    

    public function delete($id) {
        
        $repo = new movieRepository($this->db);
        $movie = $repo->idFilm($id);
        header('Content-Type: application/json');
        if ($movie && $movie->getId()) {
            $repo->deleteMovie($movie);
            echo json_encode($movie);
        } else {
            http_response_code(404);
        }
    }
    }

