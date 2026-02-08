<?php
class screeningRepository
{
    private $db;


    public function __construct($connexion)
    {
        $this->db = $connexion;
    }

    public function hasConflict($movieId, $roomId, $startTime, $excludeScreeningId = null)
    {
        $stmtMovie = $this->db->prepare("SELECT duration FROM movies WHERE id = ?");
        $stmtMovie->execute([$movieId]);
        $movieData = $stmtMovie->fetch(PDO::FETCH_ASSOC);

        if (!$movieData || !$movieData['duration']) {
            throw new Exception('Film not found or has no duration');
        }

        $sql = "SELECT COUNT(*) as count FROM screenings s
            JOIN movies m ON s.movie_id = m.id
            WHERE s.room_id = ? 
            AND s.active = true
            AND s.start_time < DATE_ADD(?, INTERVAL ? MINUTE)
            AND DATE_ADD(s.start_time, INTERVAL m.duration MINUTE) > ?";

        $params = [$roomId, $startTime, $movieData['duration'], $startTime];

        if ($excludeScreeningId) {
            $sql .= " AND s.id != ?";
            $params[] = $excludeScreeningId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }


    public function screeningAll()
    {
        $sql = "SELECT * FROM screenings WHERE active = true";
        $result = $this->db->query($sql);
        $screening = [];

        while ($row = $result->fetch()) {
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

    public function addScreening($r)
    {
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

    public function updateScreening($r)
    {
        $sql = "UPDATE screenings SET movie_id = ?, room_id = ?, start_time = ? WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([
            $r->getMovieId(),
            $r->getRoomId(),
            $r->getStartTime()
        ]);

        return $r;
    }

    public function softDeleteScreening($id)
    {
        $sql = "UPDATE screenings SET active = false WHERE id = ?";
        $result = $this->db->prepare($sql);
        return $result->execute([$id]);
    }

    public function deleteScreening($r)
    {
        $sql = "DELETE FROM screenings WHERE id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([$r->getId()]);
        return $r;
    }
}
