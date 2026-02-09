<?php

class screening implements JsonSerializable
{
    private $id;
    private $movie_id;
    private $room_id;
    private $start_time;
    private $active;  
    private $created_at;

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "movie_id" => $this->movie_id,
            "room_id" => $this->room_id,
            "start_time" => $this->start_time,
            "active" => $this->active,
            "created_at" => $this->created_at
        ];
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMovieId($movie_id)
    {
        $this->movie_id = (int)$movie_id;
    }

    public function setRoomId($room_id)
    {
        $this->room_id = (int)$room_id;
    }
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    public function setActive($active) {
       $this->active = $active;
   }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMovieId()
    {
        return $this->movie_id;
    }

    public function getRoomId()
    {
        return $this->room_id;
    }

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function getActive() {
       return $this->active;
   }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
