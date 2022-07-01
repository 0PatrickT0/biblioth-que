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

    <!-- Bootstrap Core CSS -->
    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <!--    Support paging via http://www.tutorialspoint.com/php/mysql_paging_php.htm-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
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
    <div class="library">
        <div class="row">
            <?php
            $sql = 'SELECT img, title, year, description, isbn, edition, author FROM books INNER JOIN authors ON books.id_author = authors.id ORDER BY title';
            foreach ($pdo->query($sql) as $book) {
            ?>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src=<?=$book['img'];?>>
                        <div class="caption">
                            <h3><?=$book['title'];?></h3>
                            <h4>Auteur: <?=$book['author'];?></h4>
                            <h5>Edition: <?=$book['edition'];?></h5>
                            <br>
                            <h5>Résumé: <?=$book['description'];?></h5>
                            <br>
                            <h5><p class="isbn"> ISBN: <?=$book['isbn'];?></p></h5>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
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