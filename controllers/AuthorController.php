<?php

include_once ROOT . "/models/AuthorModel.php";
include_once ROOT . "/models/PublisherModel.php";
include_once ROOT . "/models/BookModel.php";

class AuthorController {

    public function actionIndex() {
        
        $loader = new Twig_Loader_Filesystem(ROOT . "/views/authors");
        $twig = new Twig_Environment($loader);

        $authorModel = new AuthorModel();

        $authorData = $authorModel->getAuthors();

        echo $twig->render('index.html', array("authors" => $authorData));

        return true;
    }

    public function actionView($id)
    {
        $loader = new Twig_Loader_Filesystem(ROOT . "/views/authors");
        $twig = new Twig_Environment($loader);

        $authorModel = new AuthorModel();
        $publisherModel = new PublisherModel();
        $bookModel = new BookModel();

        $bookData = $bookModel->getBooksByAuthor($id);

        $result = array();

        foreach ($bookData as $row) {
            $authorName = $authorModel->getName($id);
        	$publisherID = $row["publisher_id"];
        	$publisherName = $publisherModel->getName($publisherID); 

        	$res = array(
            	"id" => $row["id"],
            	"name" => $row["name"],
            	"publisherID" => $publisherID,
            	"publisher" => $publisherName["name"]
        	);

        	array_push($result, $res);
        }

        $result["author"] = $authorName["name"];

        echo $twig->render('author.html', array("books" => $result));
        
        return true;
    }

}