<?php

include_once ROOT . "/components/source/DBSource.php";

class AuthorModel
{
    private $connection;

    public function __construct() {
        $this->connection = DBSource::getConnection();
    }

    public function checkID($id)
    {
        $sth = $this->connection->prepare(
            "SELECT id FROM author 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_LAZY);
    }

    public function getAuthors()
    {
        $sth = $this->connection->prepare("SELECT * FROM author");
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getName($id)
    {
        $sth = $this->connection->prepare(
            "SELECT name FROM author 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name)
    {
        $sth = $this->connection->prepare(
            "UPDATE author 
            SET name=:name 
            WHERE id=:id"
        );
        $sth->execute(array(
            "id" => $id,
            "name" => $name
        ));
    }

    public function save($name)
    {
        $sth = $this->connection->prepare(
            "INSERT INTO author (name) 
            VALUES (:name)"
        );
        $sth->execute(array(
            "name" => $name
        ));
    }
}