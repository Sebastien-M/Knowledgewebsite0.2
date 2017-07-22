<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-HzUaiJdCTIY/RL2vDPRGdEQHHahjzwoJJzGUkYjHVzTwXFQ2QN/nVgX7tzoMW3Ov" crossorigin="anonymous">

        <title>Document</title>
    </head>
    <body>
        <?php
        require_once 'website-parts/header.php';
        ?>
        <div class="page-header container-fluid col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
            <h1 class="">Inscription</h1>
        </div>
        <main class="container-fluid">
            <form class=" row col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3" action=""method="POST">
                <div class="form-group">
                    <label class="form-control-label" for="nom">Nom*</label>
                    <input class="form-control form-control-success" id="nom" type="text" name="nom">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="mail">Email*</label>
                    <input class="form-control" type="email" id="mail" name="email">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="mdp">Mot de passe*</label>
                    <input class="form-control" type="password" id="mdp" name="password">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="bio">Bio</label>
                    <input class="form-control" type="text" id="bio" name="bio">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="age">age*</label>
                    <input class="form-control" type="date" id="age" name="age">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="avatar">Avatar</label>
                    <input class="form-control-file" type="file" id="avatar" name="avatar">
                </div>
                <input class="btn btn-primary" type="submit" value="Envoyer">
            </form>
        </main>
        <div class="container">
            <?php
            include_once 'classes/Utilisateur.php';
            include_once 'classes/db.php';
            $db = new db();
            $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            if (!empty($post["nom"]) || !empty($post["email"]) || !empty($post["password"]) || !empty($post["age"])) {
                $utilisateur = new Utilisateur(htmlspecialchars($post["nom"]), htmlspecialchars($post["email"]), htmlspecialchars($post["avatar"]), htmlspecialchars($post["bio"]), htmlspecialchars($post["age"]));
                $utilisateur->setPassword(password_hash($post["password"], PASSWORD_BCRYPT));
                $db->new_user($utilisateur);
                $_SESSION['user'] = $utilisateur;
                $_SESSION['connected'] = true;
                $_SESSION['pseudo'] = htmlspecialchars($post["nom"]);
                //header("Refresh:0; url=index.php");
            } else if (isset($post["nom"])) {
                if (empty($post["nom"]) || empty($post["email"]) || empty($post["password"]) || empty($post["age"])) {
                    echo "<p>Formulaire incomplet</p>";
                }
            }
            ?>
            <p class=>* Champs obligatoires</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    </body>
</html>