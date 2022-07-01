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
                        <a href="/admin.php">Module d'administration</a>
                    </li>
                    <li>
                        <a href="/modify_book_new.php">Mode sans echec</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="grid">
        <!--Début ajout livre-->
        <div>
            <?php
            $rech = ("SELECT * FROM authors ORDER BY author ASC");
            $resultat = $pdo->prepare($rech);
            $resultat->execute();
            if (isset($_POST['post_book'])) {
                try {
                    $title = $_POST['title'];
                    $id_author = $_POST['author'];
                    $year = $_POST['year'];
                    $description = $_POST['description'];
                    $isbn = $_POST['isbn'];
                    $edition = $_POST['edition'];
                    $img = $_POST['img'];
                    $sth = $pdo->prepare("INSERT INTO books (title, year, description, isbn, edition, img, id_author) VALUES (:title, :year, :description, :isbn, :edition, :img, :id_author)");
                    $sth->execute(array(
                        ':title' => $title,
                        ':year' => $year,
                        ':description' => $description,
                        ':isbn' => $isbn,
                        ':edition' => $edition,
                        ':img' => $img,
                        ':id_author' => $id_author
                    ));
                    echo "Livre ajoutée";
                } catch (PDOException $e) {
                    echo "Erreur:" . $e->getMessage();
                }
            }
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
                <div>
                    <label for="img">Image :</label>
                    <input type="text" id="img" name="img" required>
                </div>
                <div class="button">
                    <button type="submit" name="post_book"> Ajouter à la bibliotèque </button>
                </div>
            </form>
        </div>
        <!--Fin ajout livre-->
        <!--Début modification-->
        <!--Fin modification-->
        <!--Début ajout auteur-->
        <div>
            <?php
            if (isset($_POST['post_author'])) {
                try {
                    $author = $_POST['create_author'];
                    $sth = $pdo->prepare("INSERT INTO authors (author) VALUES (:author)");
                    $sth->execute(array(':author' => $author));
                    echo "Auteur ajouté";
                } catch (PDOException $e) {
                    echo "Erreur:" . $e->getMessage();
                }
            }
            ?>
            <form action="/create_book.php" method="post">
                <div>
                    <label for="create_author">Création de l'auteur :</label>
                    <input type="text" id="create_author" name="create_author" required>
                </div>
                <div class="button">
                    <button type="submit" name="post_author"> Ajouter l'auteur </button>
                </div>
            </form>
        </div>
        <!--Fin ajout auteur-->
        <!--Début suppression-->
        <div>
            <?php
            $rech = ("SELECT * FROM books ORDER BY title ASC");
            $resultat = $pdo->prepare($rech);
            $resultat->execute();
            if (isset($_POST['post_delete_book'])) {
                try {
                    $title = $_POST['title'];
                    $sth = $pdo->prepare("DELETE FROM books WHERE title = (:title)");
                    $sth->execute(array(
                        ':title' => $title,
                    ));
                    echo "Livre supprimé";
                } catch (PDOException $e) {
                    echo "Erreur:" . $e->getMessage();
                }
            }
            ?>
            <form action="" method="post">
                <div>
                    <label for="title">Titre :</label>
                    <select id="title" name="title" required>
                        <?php
                        while ($ligne = $resultat->fetch())
                            echo "<option value='" . $ligne['title'] . "'>" . $ligne['title'] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="button">
                    <button type="submit" name="post_delete_book"> Supprimer de la bibliotèque </button>
                </div>
            </form>
        </div>
        <!--Fin suppression-->
    </div>
</body>

</html>