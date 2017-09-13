<?php
session_start();
?>
<!DOCTYPE  html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-HzUaiJdCTIY/RL2vDPRGdEQHHahjzwoJJzGUkYjHVzTwXFQ2QN/nVgX7tzoMW3Ov" crossorigin="anonymous">
        <title>
            <?php
            require_once '../classes/db.php';
            $db = new db();
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            //au clic sur la page article choisi = article cliqué
            if (!isset($get['article'])) {
                $_SESSION['articleChoisi'] = $_SESSION['articleChoisi'];
            } else if (!isset($get['commentaire'])) {
                $_SESSION['articleChoisi'] = $get['article'];
            }

            //Header
            $article = $db->readSingleArticle($get['article']);
            echo $article['discipline'];
            ?>
        </title>
    </head>
    <body>
        <?php
            require_once './headercourse.php';
        ?>
        <main>
            <?php
            echo "<h1>" . $article['titre'] . "</h1>";
            echo "<p style='word-wrap: break-word;'>" . $article['contenu'] . "</p>";
            ?>
        </main>
        <a href="../index.php">Retour au menu</a>

        <?php
        // si connecté afficher form pour commentaires
        if (isset($_SESSION['connected'])) {
            echo "<form style='' action='' method='POST'>";
            echo "<label>Nouveau commentaire</label>";
            echo "<textarea style='width:50%;height:20%;resize: none;display: flex;' name='commentaire' id='content'></textarea>";
            echo "<input type='submit' value='envoyer'>";
            echo "</form>";
        }
        //si connecté et commentaire rempli
        if (!empty($post['commentaire'])) {
            $comment = new Commentaire($_SESSION['pseudo'], $post['commentaire'], $article['id']);
            $db->newComment($comment);
        }
//    // si non connecté pas de commentaires possible
//    else if (!isset($_SESSION['connected'])) {}
//    
        //si connecté et commentaire vide
        else if (isset($post['commentaire']) && $post['commentaire'] === "") {
            echo "Commentaire vide";
        }

        //Supprimer commentaire si post delete
        if (isset($post['idcomment'])) {
            $db->deleteComment($post['idcomment']);
        }
        //supprimer cours si auteur = self
        if (!empty($post['idarticle'])) {
            $db->deletearticle($post['idarticle']);
            header("Refresh:0; url=../index.php");
        }
        if (isset($_SESSION['connected'])) {
            if ($article['auteur'] === $_SESSION['pseudo']) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='idarticle' value='" . $article['id'] . "'>";
                echo "<button type='submit'>Supprimer article</button>";
                echo "</form>";
            }
        }
        echo "<p>Commentaires : </p>";
        //Afficher les commentaires
        $commentaires = $db->readComments($article['id']);
        foreach ($commentaires as $key => $value) {
            echo $value['commentaire'] . "</br>";
            echo $value['auteur'] . "</br>";
            echo $value['date'] . "</br>";
            if (!empty($_SESSION['pseudo'])) {
                if ($_SESSION['pseudo'] == $value['auteur']) {
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='idcomment' value='" . $value['id'] . "'>";
                    echo "<input type='submit' value='Supprimer commentaire'>";
                    echo "</form></br>";
                }
            }
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    </body>
</html>