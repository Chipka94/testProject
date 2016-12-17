<?php

include_once ROOT . "/components/source/DBSource.php";

class PublisherModel extends DBSource
{
    private $connection;

    public function __construct() {
        $this->connection = self::getConnection();
    }

    public function checkID($id)
    {
        $sth = $this->connection->prepare(
            "SELECT id FROM publisher 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_LAZY);
    }

    public function getPublishers()
    {
        $sth = $this->connection->prepare("SELECT * FROM publisher");
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getName($id)
    {
        $sth = $this->connection->prepare(
            "SELECT name FROM publisher 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $link)
    {
        $sth = $this->connection->prepare(
            "UPDATE publisher 
            SET name=:name, link=:link 
            WHERE id=:id"
        );
        $sth->execute(array(
            "id" => $id,
            "name" => $name,
            "link" => $link
        ));
    }

    public function save($name, $link)
    {
        $sth = $this->connection->prepare(
            "INSERT INTO publisher (name, link) 
            VALUES (:name, :link)"
        );
        $sth->execute(array(
            "name" => $name,
            "link" => $link
        ));
    }
}