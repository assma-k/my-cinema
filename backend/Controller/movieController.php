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
        $data = [];
        foreach ($movies as $m) {
            $data[] = [
                "id" => $m->getId(),
                "title" => $m->getTitle(),
                "description" => $m->getDescription(),
                "duration" => $m->getDuration(),
                "release_year" => $m->getReleaseYear(),
                "genre" => $m->getGenre(),
                "director" => $m->getDirector(),
                "created_at" => $m->getCreatedAt(),
                "updated_at" => $m->getUpdatedAt()
            ];
            
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }


    public function show($id)
    {
        $repo = new movieRepository($this->db);
        $movie = $repo->idFilm($id);
        header('Content-Type: application/json');
        if ($movie->getId()) {
            echo json_encode($movie);
            exit;
        } else {
            http_response_code(404);
        }
    }

    public function add()
    {
        $data = json_decode(file_get_contents('php://input'));
        $m = new movie();
        $m->setTitle($data->title);
        $m->setDescription($data->description);
        $m->setDuration($data->duration);
        $m->setReleaseYear($data->release_year);
        $m->setGenre($data->genre);
        $m->setDirector($data->director);
        $m->setCreatedAt(date('Y-m-d H:i:s'));
        $m->setActive(1);
        $repo = new movieRepository($this->db);
        $repo->addMovie($m);
        header('Content-Type: application/json');
        echo json_encode($m);
         exit;
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $m = new movie();
        $m->setId($id);
        $m->setTitle($data['title']);
        $m->setDescription($data['description']);
        $m->setDuration($data['duration']);
        $m->setReleaseYear($data['release_year']);
        $m->setGenre($data['genre']);
        $m->setDirector($data['director']);
        $m->setUpdatedAt(date('Y-m-d H:i:s'));
        $repo = new movieRepository($this->db);
        $repo->uploadMovie($m);
        header('Content-Type: application/json');
        echo json_encode($m);
         exit;
    }


    public function delete($id)
    {

        $repo = new movieRepository($this->db);
        $movie = $repo->idFilm($id);
        header('Content-Type: application/json');
        if ($movie && $movie->getId()) {
            $repo->softDeleteMovie($movie->getId());
            echo json_encode($movie->getId());
            exit;
        } else {
            http_response_code(404);
        }
    }
}
