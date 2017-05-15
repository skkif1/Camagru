<?php

class Message
{
    private $id;
    private $text;
    private $author;
    private $photoId;

    public function __construct($id, $text, $authorId, $photoId)
    {
        $this->id = $id;
        $this->text = $text;
        $this->author = $authorId;
        $this->photoId = $photoId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getPhotoId()
    {
        return $this->photoId;
    }

    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;
    }




}


