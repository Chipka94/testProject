<?php

include_once ROOT . "/models/AuthorModel.php";
include_once ROOT . "/models/PublisherModel.php";
include_once ROOT . "/models/BookModel.php";

class PublisherController {

    public function actionIndex() {
        
        $loader = new Twig_Loader_Filesystem(ROOT . "/views/publishers");
        $twig = new Twig_Environment($loader);

        $publisherModel = new PublisherModel();

        $publisherData = $publisherModel->getPublishers();

        echo $twig->render('index.html', array("publishers" => $publisherData));

        return true;
    }

    public function actionView($id)
    {
        $loader = new Twig_Loader_Filesystem(ROOT . "/views/publishers");
        $twig = new Twig_Environment($loader);

        $authorModel = new AuthorModel();
        $publisherModel = new PublisherModel();
        $bookModel = new BookModel();

        $bookData = $bookModel->getBooksByPublisher($id);

        $result = array();

        foreach ($bookData as $row) {
        	$authorID = $row["author_id"];
            $authorName = $authorModel->getName($authorID);
        	$publisherName = $publisherModel->getName($id); 

        	$res = array(
            	"id" => $row["id"],
            	"name" => $row["name"],
            	"authorID" => $authorID,
            	"author" => $authorName["name"]
        	);

        	array_push($result, $res);
        }

        $result["publisher"] = $publisherName["name"];

        echo $twig->render('publisher.html', array("books" => $result));
        
        return true;
    }
}