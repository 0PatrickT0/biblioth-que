<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Interface</title>

    <link href="style.css" rel="stylesheet">

    <style>
        form {
            margin: 0 auto;
            margin-top: 10px;
            width: 400px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
        }

        form div {
            margin-top: 1em;
        }

        label {
            display: inline-block;
            width: 300px;
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
            text-align: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 450px);
            grid-template-rows: repeat(2, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
        }

        .one {
            grid-column: 1;
            grid-row: 1 / 3;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Bibliothèque</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/index.php">Liste des livres</a>
                    </li>
                    <li>
                        <a href="/create_book.php">Ajout/Suppression</a>
                    </li>
                    <li>
                        <a href="/modify_book.php">Modification</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="grid">
        <!--Début ajout livre-->
        <!--Fin ajout livre-->
        <!--Début modification-->
        <div class="one">
            <?php
            $rech = ("SELECT * FROM books ORDER BY title ASC");
            $resultat = $pdo->prepare($rech);
            $resultat->execute();
            ?>
            <form action="" method="POST">
                <label for="id-number">Titre à modifier</label>
                <select id="title" name="id-number" required>
                    <?php
                    while ($ligne = $resultat->fetch())
                        echo "<option value='" . $ligne['id'] . "'>" . $ligne['title'] . "</option>";
                    ?>
                </select>
                <div class="button">
                    <button type="submit">Sélectionner</button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = ($_POST['id-number']);
                $query = "SELECT * FROM books WHERE id = $id";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $m_books = $statement->fetchAll();
                $title = $m_books[0]['title'];
                $description = $m_books[0]['description'];
                $edition = $m_books[0]['edition'];
                $img = $m_books[0]['img'];
                $isbn = $m_books[0]['isbn']; ?>
                <form action="" method="POST">
                    <input type="hidden" name="id-number" value="<?php echo $id; ?>" />
                    <div>
                        <label for="modify_title">Titre: <?php echo $title ?></label>
                        <br>
                        <input type="text" id="modify_title" name="modify_title" value="<?php echo $title ?>" required autofocus>
                    </div>
                    <div>
                        <label for="modify_description">Description: <?php echo $description ?></label>
                        <br>
                        <input type="text" id="modify_description" name="modify_description" value="<?php echo $description ?>" required>
                    </div>
                    <div>
                        <label for="modify_edition">Edition: <?php echo $edition ?></label>
                        <br>
                        <input type="text" id="modify_edition" name="modify_edition" value="<?php echo $edition ?>" required>
                    </div>
                    <div>
                        <label for="modify_img">Image: <?php echo $img ?></label>
                        <br>
                        <input type="text" id="modify_img" name="modify_img" value="<?php echo $img ?>" required>
                    </div>
                    <div>
                        <label for="modify_isbn">ISBN: <?php echo $isbn ?></label>
                        <br>
                        <input type="text" id="modify_isbn" name="modify_isbn" value="<?php echo $isbn ?>" required>
                    </div>
                    <div class="button">
                        <button type="submit">Modifier le titre</button>
                    </div>
                </form>
            <?php
            }
            if (isset($_POST["modify_title"], $_POST["modify_description"], $_POST["modify_edition"], $_POST["modify_img"], $_POST["modify_isbn"])) {
                $modify_title = trim($_POST['modify_title']);
                $modify_description = trim($_POST['modify_description']);
                $modify_edition = trim($_POST['modify_edition']);
                $modify_img = trim($_POST['modify_img']);
                $modify_isbn = trim($_POST['modify_isbn']);
                $updateQuery = "UPDATE books SET title = :modify_title, description = :modify_description, edition = :modify_edition, img = :modify_img, isbn = :modify_isbn WHERE id = :id";
                $statement = $pdo->prepare($updateQuery);
                $statement->bindValue(':modify_title', $modify_title, \PDO::PARAM_STR);
                $statement->bindValue(':modify_description', $modify_description, \PDO::PARAM_STR);
                $statement->bindValue(':modify_edition', $modify_edition, \PDO::PARAM_STR);
                $statement->bindValue(':modify_img', $modify_img, \PDO::PARAM_STR);
                $statement->bindValue(':modify_isbn', $modify_isbn, \PDO::PARAM_STR);
                $statement->bindValue(':id', $_POST['id-number'], \PDO::PARAM_INT);
                $statement->execute();
                echo "Mise à jour effectuée !";
            }
            ?>
            <?php
            #$query = "SELECT * FROM books";
            #$statement = $pdo->prepare($query);
            #$statement->execute();
            #$booksList = $statement->fetchAll();
            #echo '<br>';
            #foreach ($booksList as $m_books) {
            #    echo $m_books['id'] . ' ' . $m_books['title'];
            #    echo '<br>';
            #}
            ?>
        </div>
        <!--Fin modification-->
        <!--Début ajout auteur-->
        <!--Fin ajout auteur-->
        <!--Début suppression-->
        <!--Fin suppression-->
    </div>
</body>

</html>