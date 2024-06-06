<?php

namespace App\Controller\CategoriesController;

use \PDO;


function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/booksModel.php';
    $books = \App\Models\BooksModel\findAllByCategoryId($connexion, $id);

    include_once '../app/models/tagsModel.php';

    global $content, $title;
    $title = "category books";
    ob_start();
    include '../app/views/pages/categories/_show.php';
    $content = ob_get_clean();
}
