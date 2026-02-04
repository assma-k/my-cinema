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

    public function
}