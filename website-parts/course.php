<?php
session_start();
?>
<!DOCTYPE  html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="http://bootswatch.com/cyborg/bootstrap.css"/>
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
        ?>
        <title>
            <?php
            //Header
            $article = $db->readSingleArticle($get['article']);
            echo $article['discipline'];
            ?>
        </title>
    </head>
    <body>
    <xmp theme="bootswatch" style="display:none;">
<?php
//Markdown
        echo "<h1>" . $article['titre'] . "</h1>";
        echo "<p style='word-wrap: break-word;'>" . $article['contenu'] . "</p>";
?>
    </xmp>
    <a href="../index.php">Retour au menu</a>
    <script src="http://strapdownjs.com/v/0.2/strapdown.js"></script>

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
    // si non connecté pas de commentaires possible
    else if (!isset($_SESSION['connected'])) {
        
    }
    //si connecté et commentaire vide
    else if (isset($post['commentaire']) && $post['commentaire'] === "") {
        echo "Commentaire vide";
    }

    //Supprimer commentaire si post delete
    if (isset($post['idcomment'])) {
        $db->deleteComment($post['idcomment']);
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
                echo "<input type='hidden' name='idcomment' value='".$value['id']."'>";
                echo "<input type='submit' value='Supprimer commentaire'>";
                echo "</form></br>";
            }
        }
    }
    ?>


</body>
</html>