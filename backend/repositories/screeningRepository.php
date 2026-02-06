<?php
class screeningRepository{
    private $db;

    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function screeningAll(){
        $sql = "SELECT * FROM screenings";
        $result = $this->db->query($sql);
        $screening = [];

        while($row = $result->fetch()) {
            $s = new screening();
            $s->setMovieId($row["movie_id"]);
            $s->setRoomId($row["room_id"]);
            $s->setStartTime($row["start_time"]);
            $s->setCreatedAt($row["created_at"]);
            $screening[] = $s;
        }
        return $screening;
    }

    public function idScreen($id)
   {
      $sql = "SELECT * FROM screenings WHERE id = ?";
      $result = $this->db->prepare($sql);
      $result->execute([$id]);
      $row = $result->fetch(PDO::FETCH_ASSOC);
       $s = new screening();
        $s->setId($row["id"]);
        $s->setMovieId($row["movie_id"]);
        $s->setRoomId($row["room_id"]);
        $s->setStartTime($row["start_time"]);
        $s->setCreatedAt($row["created_at"]);
      return $s;
   }

    public function addScreening($r) {
        $sql = "INSERT INTO screenings (movie_id, room_id, start_time, created_at) VALUES (?, ?, ?, ?)";
        $result = $this->db->prepare($sql);
        $result->execute([
            $r->getMovieId(),
            $r->getRoomId(),
            $r->getStartTime(),
            $r->getCreatedAt()
        ]);
        $id = $this->db->lastInsertId();
        $r->setId($id);
        return $r;
    }

    public function updateScreening($r){
        $sql = "UPDATE screenings SET movie_id = ?, room_id = ?, start_time = ? WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([
            $r->getMovieId(),
            $r->getRoomId(),
            $r->getStartTime()
        ]);

        return $r;
    }

    public function deleteScreening($r) {
        $sql = "DELETE FROM screenings WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([$r->getId()]);
        return $r;
    }
}