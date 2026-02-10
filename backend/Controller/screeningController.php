<?php
class screeningController
{
    private $db;

    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function index()
    {
        $repo = new screeningRepository($this->db);
        $screen = $repo->screeningAll();

        header('Content-Type: application/json');
        echo json_encode($screen);
         exit;
    }

    public function show($id)
    {
        $repo = new screeningRepository($this->db);
        $screen = $repo->idScreen($id);
        header('Content-Type: application/json');
        if ($screen->getId()) {
            echo json_encode($screen);
             exit;
        } else {
            http_response_code(404);
        }
    }

    public function add()
    {
        $data = json_decode(file_get_contents('php://input'));
        $s = new screening();
        $s->setMovieId($data->movie_id);
        $s->setRoomId($data->room_id);
        $s->setStartTime($data->start_time);
        $s->setCreatedAt(date('Y-m-d H:i:s'));

        $repo = new screeningRepository($this->db);
        $repo->addScreening($s);
        header('Content-Type: application/json');
        echo json_encode($s);
         exit;
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'));
        $s = new screening();
        $s->setId($id);
        $s->setMovieId($data->movie_id);
        $s->setRoomId($data->room_id);
        $s->setStartTime($data->start_time);
        $repo = new screeningRepository($this->db);
        $repo->updateScreening($s);
        header('Content-Type: application/json');
        echo json_encode($s);
         exit;
    }


    public function delete($id)
    {

        $repo = new screeningRepository($this->db);
        $s = $repo->idScreen($id);
        header('Content-Type: application/json');
        if ($s && $s->getId()) {
            $repo->softDeleteScreening($s->getId());
            echo json_encode($s->getId());
             exit;
        } else {
            http_response_code(404);
        }
    }
}
