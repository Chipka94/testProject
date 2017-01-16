<?php

class BookController {

    public function actionIndex() {

        $twig = TwigInit::init();

        // модели
        $authorModel = new AuthorModel();
        $publisherModel = new PublisherModel();
        $bookModel = new BookModel();

        $bookData = $bookModel->getBooks();      
        $result = array();

        // получение данных с БД и рендеринг страницы
        foreach ($bookData as $row) {
            $authorID = $row["author_id"];
            $authorName = $authorModel->getName($authorID);
            $publisherID = $row["publisher_id"];
            $publisherName = $publisherModel->getName($publisherID); 

            $res = array(
                "id" => $row["id"],
                "name" => $row["name"],
                "publisherID" => $publisherID,
                "publisher" => $publisherName["name"],
                "authorID" => $authorID,
                "author" => $authorName["name"]
            );

            array_push($result, $res);
        }

        echo $twig->render('bookIndex.twig', array("books" => $result));

        return true;
    }

    public function actionView($id)
    {
        $twig = TwigInit::init();

        $authorModel = new AuthorModel();
        $publisherModel = new PublisherModel();
        $bookModel = new BookModel();

        $bookData = $bookModel->getBook($id);

        $authorID = $bookData["author_id"];
        $authorName = $authorModel->getName($authorID);
        $publisherID = $bookData["publisher_id"];
        $publisherName = $publisherModel->getName($publisherID); 

        $res = array(
            "id" => $bookData["id"],
            "name" => $bookData["name"],
            "publisherID" => $publisherID,
            "publisher" => $publisherName["name"],
            "authorID" => $authorID,
            "author" => $authorName["name"],
            "isbn" => $bookData["isbn"],
            "pages" => $bookData["pages"]
        );

        echo $twig->render('bookView.twig', array("book" => $res));
        
        return true;
    }

}