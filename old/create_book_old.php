<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
?>
<html>

<head>
    <title>Création de fiche</title>
    <meta charset="UTF-8">
    <style>
        form {
            margin: 0 auto;
            margin-top: 100px;
            width: 400px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
            display: flex;
            flex-wrap: wrap;
        }

        form div+div {
            margin-top: 1em;
        }

        label {
            display: inline-block;
            width: 90px;
            text-align: right;
        }

        input,
        textarea {
            /* Pour s'assurer que tous les champs texte ont la même police.
     Par défaut, les textarea ont une police monospace */
            font: 1em sans-serif;
            /* Pour que tous les champs texte aient la même dimension */
            width: 300px;
            box-sizing: border-box;
            /* Pour harmoniser le look & feel des bordures des champs texte */
            border: 1px solid #999;
        }

        input:focus,
        textarea:focus {
            /* Pour souligner légèrement les éléments actifs */
            border-color: #000;
        }

        textarea {
            /* Pour aligner les champs texte multi‑ligne avec leur étiquette */
            vertical-align: top;
            /* Pour donner assez de place pour écrire du texte */
            height: 5em;
        }

        .button {
            padding-left: 90px;
        }
    </style>
</head>

<body>
    <?php
    $rech = ("SELECT * FROM authors ORDER BY author ASC");
    $resultat = $pdo->prepare($rech);
    $resultat->execute();
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $id_author = $_POST['author'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $isbn = $_POST['isbn'];
        $edition = $_POST['edition'];
        $query = "INSERT INTO books (title, year, description, isbn, edition, id_author) VALUES ('$title', '$year', '$description', '$isbn', '$edition', '$id_author')";
        $statement = $pdo->exec($query);
    }


    /*$title = $_POST['title'];*/
    /*$author = $_POST['author'];*/
    /*$year = $_POST['year'];*/
    /*$description = $_POST['description'];*/
    /*$isbn = $_POST['isbn'];*/
    /*$edition = $_POST['edition'];*/
    /*$query = "INSERT INTO books (title, year, description, isbn, edition) VALUES ('$title', '$year', '$description', '$isbn', '$edition')";*/
    /*$statement = $pdo->exec($query);*/
    /*$title = trim($_POST['title']);*/
    /*$year = trim($_POST['year']);
    /*$description = trim($_POST['description']);
    /*$isbn = trim($_POST['isbn']);
    /*$edition = trim($_POST['edition']);

    /*$query = 'INSERT INTO books (title, year, description, isbn, edition) VALUES (:title, :year, :description, :isbn, :edition)';
    /*$statement = $pdo->prepare($query);

    /*$statement->bindValue(':title', $title, \PDO::PARAM_STR);
    /*$statement->bindValue(':year', $year, \PDO::PARAM_STR);
    /*$statement->bindValue(':description', $description, \PDO::PARAM_STR);
    /*$statement->bindValue(':isbn', $isbn, \PDO::PARAM_STR);
    /*$statement->bindValue(':edition', $edition, \PDO::PARAM_STR);

    /*$statement->execute();

    /*$friends = $statement->fetchAll();

    /*Affichage*/
    /*$query = 'SELECT * FROM friend';*/
    /*$statement = $pdo->query($query);*/
    /*$friends = $statement->fetchAll();*/

    /*foreach ($friends as [$friendsId, $friendsFirstname, $friendsLastname]) {*/
    /*echo "$friendsFirstname ";*/
    /*echo "$friendsLastname <br>";*/
    /*}*/
    ?>
    <form action="" method="post">
        <div>
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="author">Auteur :</label>
            <select id="author" name="author" required>
                <?php
                while ($ligne = $resultat->fetch())
                    echo "<option value='" . $ligne['id'] . "'>" . $ligne['author'] . "</option>";
                ?>
            </select>
        </div>
        <div>
            <label for="year">Année :</label>
            <input type="text" id="year" name="year" required>
        </div>
        <div>
            <label for="isbn">ISBN :</label>
            <input type="text" id="isbn" name="isbn" required>
        </div>
        <div>
            <label for="edition">Edition :</label>
            <input type="text" id="edition" name="edition" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="button">
            <button type="submit" name="submit"> Ajouter à la liste </button>
        </div>
    </form>
</body>

</html>