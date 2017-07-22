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
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-HzUaiJdCTIY/RL2vDPRGdEQHHahjzwoJJzGUkYjHVzTwXFQ2QN/nVgX7tzoMW3Ov" crossorigin="anonymous">

        <title></title>
    </head>
    <body>
        <?php
        require_once 'website-parts/header.php';
        require_once './classes/db.php';
        ?>
        <div class="page-header container-fluid col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
            <h1 class="">Connexion</h1>
        </div>
        <form action="" class=" row col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3" method="POST">
            <div class="form-group">
                <label for="pseudo" class="form-control-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" placeholder="Pseudo" name="pseudo">
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
            </div>
            <input class="btn btn-primary" type="submit" value="envoyer">
        </form>

        <?php
        $db = new db();
        if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
            if ($db->connect($_POST['pseudo'],$_POST["password"]) == TRUE) {
                $_SESSION['connected'] = true;
                $_SESSION['pseudo'] = htmlspecialchars($_POST["pseudo"]);
                header("Refresh:0; url=index.php");
            } else {
                echo "Mauvais pseudo ou mdp";
            }
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    </body>
</html>
