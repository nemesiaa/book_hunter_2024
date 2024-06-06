<?php

namespace App\Controller\BooksController;

use \PDO;



function indexAction(PDO $connexion)
{
    include_once '../app/models/booksModel.php';
    $books = \App\Models\BooksModel\findAllPopulars($connexion);

    include_once '../app/models/tagsModel.php';


    global $content, $title;
    $title = "Books";
    ob_start();
    include '../app/views/pages/books/_index.php';
    $content = ob_get_clean();
}

function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/booksModel.php';
    $book = \App\Models\BooksModel\findOneByBookId($connexion, $id);

    include_once '../app/models/tagsModel.php';

    global $content, $title;
    $title = "Book's title";
    ob_start();
    include '../app/views/pages/books/_show.php';
    $content = ob_get_clean();
}
