<?php

namespace App\Controller\TagsController;

use \PDO;


function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/booksModel.php';
    $books = \App\Models\BooksModel\findAllByTagId($connexion, $id);

    include_once '../app/models/tagsModel.php';

    global $content, $title;
    $title = "tag books";
    ob_start();
    include '../app/views/pages/tags/show.php';
    $content = ob_get_clean();
}
