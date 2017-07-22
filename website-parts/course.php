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

        //au clic sur la page article choisi = article cliqué
        if (!isset($_GET['article'])) {
            $_SESSION['articleChoisi'] = $_SESSION['articleChoisi'];
        } else if (!isset($_GET['commentaire'])) {
            $_SESSION['articleChoisi'] = $_GET['article'];
        }
        ?>
        <title>
            <?php
            //Header
            $article = $db->readSingleArticle($_GET['article']);
            echo $article['discipline'];
            ?>
        </title>
    </head>
    <body>
    <xmp theme="bootswatch" style="display:none;">
<?php
//Markdown
        echo "<h1>".$article['titre'] . "</h1>";
        echo "<p style='word-wrap: break-word;'>".$article['contenu']. "</p>";
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
    if (!empty($_POST['commentaire'])) {
        $comment = new Commentaire($db->readSingleArticle($_SESSION['articleChoisi'], "id"), $_SESSION["pseudo"], htmlspecialchars($_POST['commentaire']));
        $db->newComment($comment);
    }
    // si non connecté pas de commentaires possible
    else if (!isset($_SESSION['connected'])) {
        
    }
    //si connecté et commentaire vide
    else if (isset($_POST['commentaire']) && $_POST['commentaire'] === "") {
        echo "Commentaire vide";
    }
    echo "<p>Commentaires : </p>";
    //Supprimer commentaire si post delete
    if (isset($_POST['deleteid2'])) {
            $db->deleteComment($_SESSION['pseudo'],$_POST['deleteid2']);
    }
    else{}
    //lire commentaires avec meme id que l'article
    $commentaires = $db->readComments($db->readSingleArticle($_SESSION['articleChoisi'], "id"));
    foreach ($commentaires as $value) {
        //Vérifie si l'id du commentaire est le meme que l'article
        if ($value->{'id'} === $db->readSingleArticle($_SESSION['articleChoisi'], "id")) {
            echo "<br/><br/>" . $value->{'commentaire'} . "<br/>" . $value->{'date'};
            //Si un utilisateur est authentifié
            if (isset($_SESSION['connected'])) {
                //L'auteur peut supprimer ses commentairess
                if ($value->{'auteur'} === $_SESSION['pseudo']) {
                    echo "<form action='' method='POST'>" .
                    "<input type='hidden' name='deleteid2' value='" . $value->{'id2'} . "'>" .
                    "<input type='submit' value='supprimer' name='supprimer'>" .
                    "</form>";
                }
            }
        }
    }
    echo "<form action='' method='POST'>" .
    "<input type='submit' value='upvote' name='upvote'>" .
    "<input type='submit' value='downvote' name='downvote'>" .
    "</form>";
    ?>

</body>
</html>