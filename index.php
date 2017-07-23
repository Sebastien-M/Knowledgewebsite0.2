<?php
session_start();
?>
<!DOCYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-HzUaiJdCTIY/RL2vDPRGdEQHHahjzwoJJzGUkYjHVzTwXFQ2QN/nVgX7tzoMW3Ov" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
        <title>Knowledge website</title>
    </head>
    <body>

        <?php
        require_once './website-parts/header.php';
        require_once 'classes/db.php';
        include_once './classes/Utilisateur.php';
        include_once './classes/Article.php';
        ?>
        <main>
            <?php
            $db = new db();
            if (!isset($_SESSION['connected'])) {
                echo "Déconnecté";
            }
            $articles = $db->readArticles();
            $i = 0;
            //Afficher cours
            foreach ($articles as $key => $value) {
                echo "<div class = 'cours'>";
                echo "<h3 id='titre'>" . ucfirst($value['titre']) . "</h3>";
                echo "<p id='discipline'>" . ucfirst($value['discipline']) . "</p>";
                echo "<p id='discipline'>Posté par : " . ucfirst($value['auteur']) . " le ".$value['creation']."</p>";
                echo "<a href='website-parts/course.php?article=" . $value['titre'] . "'><button>Lire le cours</button></a>";
                echo "</div>";
            }
            ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    </body>
</html>