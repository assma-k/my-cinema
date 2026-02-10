<?php
class movie implements JsonSerializable {
    private $id;
    private $title;
    private $description;
    private $duration;
    private $release_year;
    private $genre;
    private $director;
    private $created_at;
    private $updated_at; 
    private $active;  
    

    public function jsonSerialize(): mixed{
       return ["id"=> $this->id,
        "title"=> $this->title,
        "description"=> $this->description,
        "duration"=> $this->duration,
        "release_year"=>$this->release_year,
        "genre"=>$this->genre,
        "director"=>$this->director,
        "created_at"=>$this->created_at,
        "updated_at"=>$this->updated_at,
    ];
    }
    public function setId($id){
        $this->id = $id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setDuration($duration){
        $this->duration = $duration;
    }

    public function setReleaseYear($release_year){
        $this->release_year = $release_year;
    }

    public function setGenre($genre){
        $this->genre = $genre;
    }

    public function setDirector($director){
        $this->director = $director;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at){
        $this->updated_at = $updated_at;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getId() {
    return $this->id;
}

public function getTitle() {
    return $this->title;
}

public function getDescription() {
        return $this->description;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getReleaseYear() {
        return $this->release_year;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

     public function getActive() {
       return $this->active;
   }
}
