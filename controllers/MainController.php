<?php

use League\Csv\Reader;

/**
 * Class MainController
 * Открытие файлов и сохранение данных в БД
 */
class MainController {

    public function actionIndex() {

        $twig = TwigInit::init();

        $errors = array();

        if (isset($_FILES['zip'])) {
            // открытие, извлечение файлов с архива
        	$res = explode('.', $_FILES['zip']['name']);
        	
        	$zip = new ZipArchive();

            if ($zip->open($_FILES['zip']['tmp_name']) === false) {
                $errors[] = 'Failed to open...';
            } else {
                if (end($res) !== 'zip') {
                    $errors[] = "No .zip file!";
                } else {
                    $zip->extractTo(ROOT . "/csv");
                    $zip->close();
                }
            }

            // чтение данных из файлов и запись в БД
        	$authorsData = Reader::createFromPath(ROOT . "/csv/authors.csv");
            $authorsData->setOffset(1);
        	$authorsData = $authorsData->fetch();

            $publishersData = Reader::createFromPath(ROOT . "/csv/publishers.csv");
            $publishersData->setOffset(1);
            $publishersData = $publishersData->fetch();

            $booksData = Reader::createFromPath(ROOT . "/csv/books.csv");
            $booksData->setOffset(1);
            $booksData = $booksData->fetch();

            $authorModel = new AuthorModel();
            $publisherModel = new PublisherModel();
            $bookModel = new BookModel();

            foreach ($authorsData as $row) {
                if ($authorModel->checkID($row[0])) {
                    $authorModel->update($row[0], $row[1]);
                } else {
                    $authorModel->save($row[1]);
                }
            }

            foreach ($publishersData as $row) {
                if ($publisherModel->checkID($row[0])) {
                    $publisherModel->update($row[0], $row[1], $row[2]);
                } else {
                    $publisherModel->save($row[1], $row[2]);
                }
            }

            foreach ($booksData as $row) {
                if ($bookModel->checkID($row[0])) {
                    $bookModel->update($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                } else {
                    $bookModel->save($row[1], $row[2], $row[3], $row[4], $row[5]);
                }
            }


            if (empty($errors)) {
                header('Location: /books');
            }
        	
        }

        echo $twig->render('index.twig', array("errors" => $errors));

        return true;
    }
}