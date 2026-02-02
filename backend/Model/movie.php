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
}
