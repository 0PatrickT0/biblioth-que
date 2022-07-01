<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
?>
<html>

<head>
    <title>Création de fiche</title>
    <meta charset="UTF-8">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            text-align: center;
            overflow: hidden;
        }
        #conteneur {
            position: absolute;
            margin-top: 50%;
            margin-left: 50%;
            top: -2cm;
            left: -4cm;
            width: 8cm;
            height: 4cm;
        }
        form {
            margin: 0 auto;
            margin-top: 20px;
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
    if (isset($_POST['submit'])) {
        $author = $_POST['create_author'];
        $query = "INSERT INTO authors (author) VALUES ('$author')";
        $statement = $pdo->exec($query);
    }
    ?>
        <div>
        <a href="/create_book.php"> Retour à la liste des livres </a>
    </div>
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
</html>