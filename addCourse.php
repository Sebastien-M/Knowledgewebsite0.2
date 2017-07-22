<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="css/header.css"/>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-HzUaiJdCTIY/RL2vDPRGdEQHHahjzwoJJzGUkYjHVzTwXFQ2QN/nVgX7tzoMW3Ov" crossorigin="anonymous">

        <title>Ajouter un cours</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION['connected'])) {

            require_once './classes/db.php';
            require_once './classes/Article.php';
            require_once './website-parts/header.php';
            ?>
            <div class="page-header container-fluid col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
                <h1 class="">Ajouter un cours</h1>
            </div>
            <div class="container-fluid">
                <form class="row col-xs-12 col-sm-12 " action=""method="POST">
                    <div class="form-group">
                        <label class="form-control-label">Titre</label>
                        <input class="form-control" type="text" name="titre">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Catégorie</label>
                        <input class="form-control" type="text" name="categorie">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Cours</label>
                        <textarea class="form-control col-md-12" style="resize: none;height: 300px;" name="cours" id="content"></textarea>
                    </div>
                    <input class="btn btn-primary" type="submit" value="envoyer">
                </form>
            </div>
            <?php
            if (!empty($_POST['titre']) && !empty($_POST['categorie']) && !empty($_POST['cours'])) {
                $db = new db();
                $course = new Article($_POST['categorie'], $_POST['titre'], $_POST['cours'], $_SESSION["pseudo"]);
                $db->newArticle($course);
            }
        } else {
            echo "<p>Vous devez être connecté pour ajouter un cours</p>";
            echo "<a href='index.php'>Retour</a>";
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    </body>
</html>
