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
      $sql = "SELECT * FROM movies";
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
      $monFilm->setCreatedAt($row["created_at"]);
      $monFilm->setUpdatedAt($row["updated_at"]);
      return $monFilm;
   }
   public function addMovie($title, $description, $duration, $release_year, $genre, $director)
   {
      $sql = "INSERT INTO movies (title, description, duration, release_year, genre, director) VALUES (?, ?, ?, ?, ?, ?) ";
      $result = $this->db->prepare($sql);
      $result->execute([$title, $description, $duration, $release_year, $genre, $director]);
      return $this->db->lastInsertId();
   }
   public function deleteMovie($id)
   {
      $sql = "DELETE FROM movies WHERE id = ?";
      $result = $this->db->prepare($sql);
      return $result->execute([$id]);
   }

   public function uploadMovie($title, $description, $duration, $release_year, $genre, $director, $id)
   {
      $sql = "UPDATE movies SET title = ?, description = ?, duration = ?, release_year = ?, genre = ?, director = ? WHERE id = ?";
      $result = $this->db->prepare($sql);
      $result->execute([$title, $description, $duration, $release_year, $genre, $director, $id]);
      return $result;
   }
}
