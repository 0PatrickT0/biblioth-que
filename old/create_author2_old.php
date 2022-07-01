<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
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

    <title>Bibliothèque</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link href="style_author.css" rel="stylesheet">
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
                <a class="navbar-brand" href="#">Bibliothèque</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/index.php">Liste des livres</a>
                    </li>
                    <li>
                        <a href="/create_author.php">Création d'un auteur</a>
                    </li>
                    <li>
                        <a href="/create_book.php">Ajout d'un livre</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="col-md-9">
        <div class="row">

            <body>
                <?php
                if (isset($_POST['submit'])) {
                    $author = $_POST['create_author'];
                    $query = "INSERT INTO authors (author) VALUES ('$author')";
                    $statement = $pdo->exec($query);
                }
                ?>
                <form action="" method="post">
                    <div>
                        <label for="create_author">Création de l'auteur :</label>
                        <input type="text" id="create_author" name="create_author" required>
                    </div>
                    <div class="button">
                        <button type="submit" name="submit"> Ajouter l'auteur </button>
                    </div>
                </form>
            </body>
        </div>
    </div>
    <div class="container">

        <!--<hr>-->

        <!-- Footer -->
        <!--<footer>
            <div class="row">
                <p>...</p>
            </div>
        </footer>-->

    </div>
</body>

</html>