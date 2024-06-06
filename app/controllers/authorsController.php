<?php

namespace App\Controller\AuthorsController;

use \PDO;

function indexAction(PDO $connexion)
{
    include_once '../app/models/authorsModel.php';
    $authors = \App\Models\AuthorsModel\findAllPopulars($connexion);


    global $content, $title;
    $title = "Authors";
    ob_start();
    include '../app/views/pages/authors/_index.php';
    $content = ob_get_clean();
}

function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/authorsModel.php';
    $author = \App\Models\AuthorsModel\findOneById($connexion, $id);

    include_once '../app/models/booksModel.php';
    $books = \App\Models\BooksModel\findAllByAuthorId($connexion, $id);

    global $content, $title;
    $title = "Author name";
    ob_start();
    include '../app/views/pages/authors/_show.php';
    $content = ob_get_clean();
}
