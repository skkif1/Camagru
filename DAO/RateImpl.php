<?php

require_once (root . "/DAO/MySqlConnection.php");

class RateImpl
{
    private $connection;

    public function __construct()
    {
        $this->connection = new MySqlConnection();
        $this->connection = $this->connection->getConnection();
    }

    public function checkRate($photoId, $authorId)
    {
        $stm = $this->connection->prepare("SELECT * FROM rate WHERE photo_id = ? AND author_id = ?");
        $stm->execute(array($photoId, $authorId));
        $rs = $stm->fetchColumn();
        return $rs;
    }

    public function updateRate($photoId, $authorId)
    {
        $stm = $this->connection->prepare("INSERT INTO rate (photo_id, author_id) VALUES (?, ?)");
        $stm->execute(array($photoId, $authorId));
    }

    public function deleteRate($photoId, $authorId)
    {
        $stm = $this->connection->prepare("DELETE FROM rate WHERE photo_id = ? AND author_id = ?");
        $stm->execute(array($photoId, $authorId));
    }
}