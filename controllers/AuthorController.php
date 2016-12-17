<?php

include_once ROOT . "/models/AuthorModel.php";
include_once ROOT . "/models/PublisherModel.php";
include_once ROOT . "/models/BookModel.php";
include_once ROOT . "/components/twig/TwigInit.php";

class AuthorController {

    public function actionIndex() {

        $twig = TwigInit::init();

        $authorModel = new AuthorModel();
        $authorData = $authorModel->getAuthors();

        echo $twig->render('authorIndex.twig', array("authors" => $authorData));

        return true;
    }

    public function actionView($id)
    {
        $twig = TwigInit::init();

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

        echo $twig->render('authorView.twig', array("books" => $result));
        
        return true;
    }

}