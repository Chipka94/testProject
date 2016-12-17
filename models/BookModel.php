<?php

include_once ROOT . "/components/source/DBSource.php";

class BookModel extends DBSource
{
    // подключение к БД
    private $connection;

    public function __construct() {
        $this->connection = self::getConnection();
    }

    public function checkID($id)
    {
        $sth = $this->connection->prepare(
            "SELECT id FROM book 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_LAZY);
    }

    public function getBook($id)
    {
        $sth = $this->connection->prepare(
            "SELECT * FROM book 
            WHERE id= :id"
        );
        $sth->execute(array("id" => $id));

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getBooksByAuthor($author_id)
    {
        $sth = $this->connection->prepare(
            "SELECT * FROM book 
            WHERE author_id= :id"
        );
        $sth->execute(array("id" => $author_id));

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooksByPublisher($publisher_id)
    {
        $sth = $this->connection->prepare(
            "SELECT * FROM book 
            WHERE publisher_id= :id"
        );
        $sth->execute(array("id" => $publisher_id));

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooks()
    {
        $sth = $this->connection->prepare("SELECT * FROM book");
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $publisher, $author, $isbn, $pages)
    {
        $sth = $this->connection->prepare(
            "UPDATE book 
            SET name=:name, 
                isbn=:isbn,
                pages=:pages,
                publisher_id=:publisher,
                author_id=:author 
            WHERE id=:id"
        );
        $sth->execute(array(
            "id" => $id,
            "name" => $name,
            "publisher" => $publisher,
            "author" => $author,
            "isbn" => $isbn,
            "pages" => $pages
        ));
    }

    public function save($name, $publisher, $author, $isbn, $pages)
    {
        $sth = $this->connection->prepare(
            "INSERT INTO book (name, isbn, pages, publisher_id, author_id) 
            VALUES (:name, :isbn, :pages, :publisher, :author)"
        );
        $sth->execute(array(
            "name" => $name,
            "publisher" => $publisher,
            "author" => $author,
            "isbn" => $isbn,
            "pages" => $pages
        ));
    }
}