<?php
class room implements JsonSerializable
{
    private $id;
    private $name;
    private $capacity;
    private $type;
    private $active;
    private $created_at;
    private $updated_at;

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "capacity" => $this->capacity,
            "type" => $this->type,
            "active" => $this->active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getCapacity()
    {
        return $this->capacity;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getActive()
    {
        return $this->active;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
