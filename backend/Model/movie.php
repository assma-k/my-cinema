<?php
class movie {
   private $db;

   public function __construct($connexion)
   {
    $this->db = $connexion;
   }
   public function film(){
    $sql = "SELECT * FROM movies";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
   }
   public function idFilm($id){
      $sql = "SELECT * FROM movies WHERE id = ?";
      $result= $this->db->prepare($sql);
      $result->execute([$id]);
      return $result->fetch(PDO::FETCH_ASSOC);
   }
   public function addMovie($title, $description, $duration, $release_year, $genre, $director){
      $sql="INSERT INTO movies (title, description, duration, release_year, genre, director) VALUES (?, ?, ?, ?, ?, ?) ";
      $result=$this->db->prepare($sql);
      $result->execute([$title, $description, $duration, $release_year, $genre, $director]);
      return $this->db->lastInsertId();
   }
   public function deleteMovie($id){
      $sql="DELETE FROM movies WHERE id = ?";
      $result=$this->db->prepare($sql);
      return $result->execute([$id]);
   }

   public function uploadMovie($title, $description, $duration, $release_year, $genre, $director, $id){
      $sql="UPDATE movies SET title = ?, description = ?, duration = ?, release_year = ?, genre = ?, director = ? WHERE id = ?";
      $result=$this->db->prepare($sql);
       $result->execute([$title, $description, $duration, $release_year, $genre, $director, $id]);
       return $result;
   }
}