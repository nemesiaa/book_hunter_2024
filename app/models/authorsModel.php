<?php

namespace App\Models\AuthorsModel;

use \PDO;

function findAllPopulars(PDO $connexion, int $limit = 30): array
{
    $sql = "SELECT a.picture, CONCAT(a.firstname, ' ', a.lastname) AS author_name, a.biography, AVG(un.note) AS note, a.id AS authorID
    FROM authors a
    INNER JOIN books b ON a.id = b.author_id
    INNER JOIN users_notations un ON b.id = un.book_id
    GROUP BY authorID
    ORDER BY note DESC
    LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findOneById(PDO $connexion, int $id): array
{
    $sql = "SELECT 
    a.picture, 
    a.id AS authorID,
    CONCAT(a.firstname, ' ', a.lastname) AS author_name, 
    a.biography, 
    AVG(un.note) AS note
    FROM authors a
    INNER JOIN books b ON b.author_id = a.id
    LEFT JOIN users_notations un ON b.id = un.book_id
    WHERE a.id = :author_id
    GROUP BY a.id
    ORDER BY note DESC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':author_id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}
