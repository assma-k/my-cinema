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
    $data = [];

    foreach ($rooms as $r) {
        $data[] = [
            "id" => $r->getId(),
            "name" => $r->getName(),
            "capacity" => $r->getCapacity(),
            "type" => $r->getType(),
            "active" => $r->getActive(),
            "created_at" => $r->getCreatedAt(),
            "updated_at" => $r->getUpdatedAt()
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

    public function show($id)
    {
        $repo = new roomRepository($this->db);
        $room = $repo->idRoom($id);
        header('Content-Type: application/json');
        if ($room->getId()) {
            echo json_encode($room);
             exit;
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
        $r->setCreatedAt(date('Y-m-d H:i:s'));
        

        $repo = new roomRepository($this->db);
        $repo->addRoom($r);
        header('Content-Type: application/json');
        echo json_encode($r);
         exit;
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true); 

        $repo = new roomRepository($this->db);
        $r = $repo->idRoom($id);
        $r->setId($id);
        $r->setName($data['name']);
        $r->setCapacity($data['capacity']);
        $r->setType($data['type']);
        $r->setActive($data['active']);
        $r->setUpdatedAt(date('Y-m-d H:i:s'));

        $repo = new roomRepository($this->db);
        $repo->updateRoom($r);

        header('Content-Type: application/json');
        echo json_encode(["success" => true]); 
        exit; 
    }


    public function delete($id)
    {

        $repo = new roomRepository($this->db);
        $r = $repo->idRoom($id);
        header('Content-Type: application/json');
        if ($r && $r->getId()) {
            $repo->softDeleteRoom($r->getId());
            echo json_encode($r->getId());
            exit;
        } else {
            http_response_code(404);
        }
    }
}
