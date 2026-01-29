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
      $sql="INSERT INTO movie (title, description, duration, release_year, genre, director) VALUE (?, ?, ?, ?, ?, ?) ";
      $result=$this->db->prepare($sql);
      return $result->execute([$title, $description, $duration, $release_year, $genre, $director]);
      return $this->db->lastInsertId();
   }
}