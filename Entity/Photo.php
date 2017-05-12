<?php

class Photo
{
    private $id;
    private $src;
    private $userId;


    public function __construct($id, $src, $userId)
    {
        if($id != 0)
        $this->id = $id;
        $this->src = $src;
        $this->userId = $userId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }




}