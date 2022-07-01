<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
?>
<html>

<head>
    <title>Bibliothèque</title>
    <meta charset="UTF-8">
    <style>
    </style>
</head>
<body>
<?php
    $sql = 'SELECT title, year, description, edition, author FROM books INNER JOIN authors ON books.id_author = authors.id ORDER BY title';
    foreach ($pdo->query($sql) as $book) {
?>
        <div class="book">
            <div class="Titre"><?=$book['title'];?></div>
            <div class="Année"><?=$book['year'];?></div>
            <div class="Description"><?=$book['description'];?></div>
            <div class="Edition"><?=$book['edition'];?></div>
            <div class="Auteur"><?=$book['author'];?></div>
        </div>
<?php
    }
?>
 
</body>

</html>