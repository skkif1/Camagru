<?php

class MessageImpl
{
    private $connection;

    public function __construct()
    {
        $this->connection = new MySqlConnection();
        $this->connection =  $this->connection->getConnection();
    }

    public function saveMessage($message)
    {
        $stm = $this->connection->prepare('INSERT INTO message(text, author, photo_id) VALUES (?, ?, ?)');
        $stm->execute(array($message->getText(), $message->getAuthor(), $message->getPhotoId()));
        return 1;
    }

    public function getMessages($photo_id)
    {
        $comments = null;
        $stm = $this->connection->prepare('SELECT author, text FROM message WHERE photo_id = ? ORDER BY creation_time');
        $stm->execute(array($photo_id));
        while($rs = $stm->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = $rs;
        }
        return $comments;
    }

}