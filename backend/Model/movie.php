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
}