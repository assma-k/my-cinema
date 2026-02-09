<?php
class roomRepository
{
    private $db;
    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function roomsAll()
    {
        $sql = "SELECT * FROM rooms";
        $result = $this->db->query($sql);
        $room = [];

        while ($row = $result->fetch()) {
            $r = new room();
            $r->setId($row['id']);
            $r->setName($row['name']);
            $r->setCapacity($row['capacity']);
            $r->setType($row['type']);
            $r->setActive($row['active']);
            $r->setCreatedAt($row['created_at']?? null);
            $r->setUpdatedAt($row['updated_at']?? null);
            $room[] = $r;
        }
        return $room;
    }

    public function idRoom($id)
   {
      $sql = "SELECT * FROM rooms WHERE id = ?";
      $result = $this->db->prepare($sql);
      $result->execute([$id]);
      $row = $result->fetch(PDO::FETCH_ASSOC);
       $r = new room();
       $r->setId($row['id']);
        $r->setName($row["name"]);
        $r->setCapacity($row["capacity"]);
        $r->setType($row["type"]);
        $r->setActive($row["active"]);
        $r->setCreatedAt($row["created_at"]);
      return $r;
   }

    public function addRoom($r)
    {
        $sql = "INSERT INTO rooms (name, capacity, type, active, created_at) VALUES (?, ?, ?, ?, ?)";
        $result = $this->db->prepare($sql);
        $result->execute([
            $r->getName(),
            $r->getCapacity(),
            $r->getType(),
            $r->getActive(),
            $r->getCreatedAt()
        ]);
        $id = $this->db->lastInsertId();
        $r->setId($id);
        return $r;
    }

    public function updateRoom($r)
    {
        $sql = "UPDATE rooms SET name = ?, capacity = ?, type = ?, active = ? WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([
            $r->getName(),
            $r->getCapacity(),
            $r->getType(),
            $r->getActive(),
            $r->getId(),
            $r->getUpdatedAt()
        ]);
        return $r;
    }

    public function deleteRoom($r)
    {
        $sql = "DELETE FROM rooms WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([$r->getId()]);
        return $r;
    }
}
