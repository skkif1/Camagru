<?php

require_once (root . "/Entity/Photo.php");

class PhotoImpl
{

    private $connection;

    public function __construct()
    {
            $this->connection = new MySqlConnection();
            $this->connection = $this->connection->getConnection();
    }

    public function savePhoto(Photo $photo)
    {
        $stm = $this->connection->prepare("INSERT INTO photo (src, user_id) VALUE (?, ?)");
        $stm->execute(array($photo->getSrc(), $photo->getUserId()));
        return $this->connection->lastInsertId();
    }

    public function getUsersPhoto($user)
    {
        $photos = null;
        $stm = $this->connection->prepare("SELECT src, id FROM photo WHERE user_id = ? ORDER BY creation_date");
        $stm->execute(array($user->getId()));
        while($rs = $stm->fetch(PDO::FETCH_ASSOC))
        {
            $photos[] = $rs;
        }
        return $photos;
    }

    public function removePhoto($id, $user)
    {
        $stm = $this->connection->prepare("DELETE FROM photo WHERE id = ? AND user_id = ?");
        $stm->execute(array($id, $user->getId()));
        return $stm->rowCount();
    }

    public function getAllPhoto($offset)
    {
        $photos = null;
        $stm = $this->connection->prepare("SELECT src, id, rate FROM photo ORDER BY creation_date DESC LIMIT 3 OFFSET $offset");
        $stm->execute();
        while($rs = $stm->fetch(PDO::FETCH_ASSOC))
        {
            $photos[] = $rs;
        }
        return $photos;
    }

    public function RatePhoto($id)
    {
        $stm = $this->connection->prepare("UPDATE photo SET rate = rate + 1 WHERE id = ?");
        $stm->execute(array($id));
        return 1;
    }

    public function RatePhotoDec($id)
    {
        $stm = $this->connection->prepare("UPDATE photo SET rate = rate - 1 WHERE id = ?");
        $stm->execute(array($id));
        return 1;
    }


    public function getRatePhoto($id)
    {
        $stm = $this->connection->prepare("SELECT rate FROM photo WHERE id = $id");
        $stm->execute(array($id));
        $rs = $stm->fetch(PDO::FETCH_ASSOC);
        return $rs;
    }
}
