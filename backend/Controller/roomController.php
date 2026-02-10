<?php
class roomController
{
    private $db;

    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function index()
    {
        $repo = new roomRepository($this->db);
        $rooms = $repo->roomsAll();

        header('Content-Type: application/json');
        echo json_encode($rooms);
    }

    public function show($id)
    {
        $repo = new roomRepository($this->db);
        $room = $repo->idRoom($id);
        header('Content-Type: application/json');
        if ($room->getId()) {
            echo json_encode($room);
        } else {
            http_response_code(404);
        }
    }

    public function add()
    {
        $data = json_decode(file_get_contents('php://input'));
        $r = new room();
        $r->setName($data->name);
        $r->setCapacity($data->capacity);
        $r->setType($data->type);
        $r->setActive($data->active);
        

        $repo = new roomRepository($this->db);
        $repo->addRoom($r);
        header('Content-Type: application/json');
        echo json_encode($r);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'));
        $r = new room();
        $r->setId($id);
        $r->setName($data->name);
        $r->setCapacity($data->capacity);
        $r->setType($data->type);
        $r->setActive($data->active);
        $r->setUpdatedAt($data->updated_at);
        $repo = new roomRepository($this->db);
        $repo->updateRoom($r);
        header('Content-Type: application/json');
        echo json_encode($r);
    }


    public function delete($id)
    {

        $repo = new roomRepository($this->db);
        $r = $repo->idRoom($id);
        header('Content-Type: application/json');
        if ($r && $r->getId()) {
            $repo->deleteRoom($r);
            echo json_encode($r);
            exit;
        } else {
            http_response_code(404);
        }
    }
}
