<?php

require_once (root . "/DAO/PhotoDao.php");
require_once (root . "/Entity/Photo.php");

class PhotoImpl implements PhotoDao
{

    private $connection;

    public function __construct()
    {
            $this->connection = new MySqlConnection();
            $this->connection = $this->connection->getConnection();
    }

    public function savePhoto(Photo $photo)
    {
        $stm = $this->connection->prepare("INSERT INTO camagru.photo (src, user_id) VALUE (?, ?)");
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
        $stm = $this->connection->prepare("SELECT src, id FROM photo ORDER BY creation_date LIMIT 3 OFFSET $offset");
        $stm->execute();
        while($rs = $stm->fetch(PDO::FETCH_ASSOC))
        {
            $photos[] = $rs;
        }
        return $photos;
    }
}
