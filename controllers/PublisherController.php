<?php

include_once ROOT . "/models/AuthorModel.php";
include_once ROOT . "/models/PublisherModel.php";
include_once ROOT . "/models/BookModel.php";
include_once ROOT . "/components/twig/TwigInit.php";

class PublisherController {

    public function actionIndex() {

        $twig = TwigInit::init();

        $publisherModel = new PublisherModel();

        $publisherData = $publisherModel->getPublishers();

        echo $twig->render('publisherIndex.twig', array("publishers" => $publisherData));

        return true;
    }

    public function actionView($id)
    {
        $twig = TwigInit::init();

        $authorModel = new AuthorModel();
        $publisherModel = new PublisherModel();
        $bookModel = new BookModel();

        $bookData = $bookModel->getBooksByPublisher($id);

        $result = array();

        foreach ($bookData as $row) {
        	$authorID = $row["author_id"];
            $authorName = $authorModel->getName($authorID);
        	$publisherName = $publisherModel->getName($id);
        	$publisherLink = $publisherModel->getLink($id);

        	$res = array(
            	"id" => $row["id"],
            	"name" => $row["name"],
            	"authorID" => $authorID,
            	"author" => $authorName["name"]
        	);

        	array_push($result, $res);
        }

        $result["publisher"] = $publisherName["name"];
        $result["link"] = $publisherLink["link"];

        echo $twig->render('publisherView.twig', array("books" => $result));
        
        return true;
    }
}