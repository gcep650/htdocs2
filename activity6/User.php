<?php

class User implements JsonSerializable {
    private $id;
    private $firstName;
    private $lastName;
    
    public function __construct($id, $firstName, $lastName) {
        $this->id=$id;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}