<?php
class movieRepository
{
   private $db;

   public function __construct($connexion)
   {
      $this->db = $connexion;
   }
   public function film()
   {
      $sql = "SELECT * FROM movies WHERE active = 1";
      $result = $this->db->query($sql);
      $rows = $result->fetchAll(PDO::FETCH_ASSOC);
      $films = [];
      foreach ($rows as $row) {
         $unfilms = new movie();
         $unfilms->setId($row["id"]);
         $unfilms->setTitle($row["title"]);
         $unfilms->setDescription($row["description"]);
         $unfilms->setDuration($row["duration"]);
         $unfilms->setReleaseYear($row["release_year"]);
         $unfilms->setGenre($row["genre"]);
         $unfilms->setDirector($row["director"]);
         $unfilms->setCreatedAt($row["created_at"]);
         $unfilms->setUpdatedAt($row["updated_at"]);
         $unfilms->setActive(1);
         $films[] = $unfilms;
      }
      return $films;
   }
   public function idFilm($id)
   {
      $sql = "SELECT * FROM movies WHERE id = ?";
      $result = $this->db->prepare($sql);
      $result->execute([$id]);
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $monFilm = new movie();
      $monFilm->setId($row["id"]);
      $monFilm->setTitle($row["title"]);
      $monFilm->setDescription($row["description"]);
      $monFilm->setDuration($row["duration"]);
      $monFilm->setReleaseYear($row["release_year"]);
      $monFilm->setGenre($row["genre"]);
      $monFilm->setDirector($row["director"]);
      $monFilm->setCreatedAt($row["created_at"]?? null);
      $monFilm->setUpdatedAt($row["updated_at"]?? null);
      return $monFilm;
   }
   public function addMovie($m){
      $sql = "INSERT INTO movies (title, description, duration, release_year, genre, director, created_at, active) VALUES (?, ?, ?, ?, ?,?, ?, ?) ";
      $result = $this->db->prepare($sql);
      
      $result->execute([
      $m->getTitle(),
      $m->getDescription(),
      $m->getDuration(),
      $m->getReleaseYear(),
      $m->getGenre(),
      $m->getDirector(),
      $m->getCreatedAt(),
      $m->getActive()
      ]);
      $id = $this->db->lastInsertId();
      $m->setId($id);
      return $m;
   }
   public function deleteMovie($m)
   {
      $sql = "DELETE FROM movies WHERE id = ?";
      $result = $this->db->prepare($sql);
      return $result->execute([$m->getId()]);
      return $m;
   }

   public function softDeleteMovie($id)
    {
        $sql = "UPDATE movies SET active = false WHERE id = ?";
        $result = $this->db->prepare($sql);
        return $result->execute([$id]);
    }


   public function uploadMovie($m)
   {
      $sql = "UPDATE movies SET title = ?, description = ?, duration = ?, release_year = ?, genre = ?, director = ?, updated_at= ? WHERE id = ?";
      $result = $this->db->prepare($sql);
      $result->execute([$m->getTitle(),
         $m->getDescription(),
      $m->getDuration(),
      $m->getReleaseYear(),
      $m->getGenre(),
      $m->getDirector(),
      $m->getUpdatedAt(),
      $m->getId()
      ]);
      return $m;
   }
}
