<?php

namespace App\Models\BooksModel;

use \PDO;

function findAllPopulars(PDO $connexion, int $limit = 30): array
{
    $sql = "SELECT b.cover, b.id AS bookID, b.title, CONCAT(a.firstname, ' ', a.lastname) AS author_name, b.resume, AVG(un.note) AS note
            FROM books b
            INNER JOIN authors a ON b.author_id = a.id
            LEFT JOIN users_notations un ON b.id = un.book_id
            GROUP BY b.id
            ORDER BY note DESC
            LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findOneByBookId(PDO $connexion, int $id): array
{
    $sql = "SELECT 
                b.cover, 
                b.id AS bookID, 
                b.title, 
                b.resume, 
                b.publicated_at,
                CONCAT(a.firstname, ' ', a.lastname) AS author_name, 
                AVG(un.note) AS note, 
                c.name AS category_name
            FROM books b
            INNER JOIN authors a ON b.author_id = a.id
            INNER JOIN categories c ON c.id = b.category_id
            LEFT JOIN users_notations un ON b.id = un.book_id
            WHERE b.id = :book_id
            GROUP BY b.id
            ORDER BY note DESC";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':book_id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}


function findAllByAuthorId(PDO $connexion, int $id): array
{
    $sql = "SELECT title 
           FROM books b
           INNER JOIN authors a ON a.id = b.author_id
           WHERE a.id = :author_id
           ORDER BY title ASC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':author_id', $id, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


function findAllByCategoryId(PDO $connexion, int $id): array
{
    $sql = "SELECT 
                b.cover, 
                c.id AS categoryID, 
                b.id AS bookID,
                b.title, 
                b.resume, 
                b.publicated_at,
                CONCAT(a.firstname, ' ', a.lastname) AS author_name, 
                AVG(un.note) AS note, 
                c.name AS category_name
            FROM books b
            INNER JOIN authors a ON b.author_id = a.id
            INNER JOIN  categories c ON c.id = b.category_id
            LEFT JOIN users_notations un ON b.id = un.book_id
            WHERE  c.id = :category_id
            GROUP BY bookID
            ORDER BY note DESC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':category_id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


function findAllByTagId(PDO $connexion, int $id): array
{
    $sql = "SELECT 
    b.cover, 
    t.id AS tagID, 
    t.name AS tag_name,
    b.id AS bookID,
    b.title, 
    b.resume, 
    b.publicated_at,
    CONCAT(a.firstname, ' ', a.lastname) AS author_name, 
    AVG(un.note) AS note, 
    c.name AS category_name
    FROM books b
    INNER JOIN authors a ON b.author_id = a.id
    INNER JOIN books_has_tags bht ON b.id = bht.book_id
    INNER JOIN tags t ON t.id = bht.tag_id
    LEFT JOIN categories c ON c.id = b.category_id
    LEFT JOIN users_notations un ON b.id = un.book_id
    WHERE t.id = :tag_id
    GROUP BY bookID
    ORDER BY note DESC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':tag_id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
