<?php

namespace App\Controllers\PageController;

use \PDO;

function homeAction(PDO $connexion)
{

    include '../app/models/booksModel.php';
    $books = \App\Models\BooksModel\findAllPopulars($connexion, 3);

    include_once '../app/models/authorsModel.php';
    $authors = \App\Models\AuthorsModel\findAllPopulars($connexion, 3);

    include '../app/models/tagsModel.php';

    global $content, $title;
    $title = "HomePage";
    ob_start();
    include '../app/views/pages/home.php';
    $content = ob_get_clean();
}
