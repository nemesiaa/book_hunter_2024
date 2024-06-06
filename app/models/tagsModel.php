<?php

namespace App\Models\TagsModel;

use \PDO;

function findAllByBookId(PDO $connexion, int $bookId): array
{
    $sql = "SELECT t.name AS tag_name, t.id AS tagID
            FROM tags t
            INNER JOIN books_has_tags bht ON t.id = bht.tag_id
            WHERE bht.book_id = :book_id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


function findAll(PDO $connexion): array
{
    $sql = "SELECT t.id AS tagID, t.name AS tag_name
            FROM tags t
            ORDER BY tag_name ASC;";

    return $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
