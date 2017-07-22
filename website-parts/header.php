
<header class="navbar navbar-default" style="color:white; height:45px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Knowledge Website</a>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php
                if ($_SERVER['PHP_SELF'] === "/projets/knowledgewebsite/index.php") {
                    echo "active";
                }
                ?>"><a href="./index.php">Cours</a></li>
            </ul>

            <?php
            function connectionActive() {
                if ($_SERVER['PHP_SELF'] === "/projets/knowledgewebsite/connection.php") {
                    return "active";
                }
            }

            function inscriptionActive() {
                if ($_SERVER['PHP_SELF'] === "/projets/knowledgewebsite/inscription.php") {
                    return "active";
                }
            }

            function addcourseActive() {
                if ($_SERVER['PHP_SELF'] === "/projets/knowledgewebsite/addCourse.php") {
                    return "active";
                }
            }

            if (!isset($_SESSION['connected'])) {
                echo "<ul class=' nav navbar-nav navbar-right'><li class='" . connectionActive() . " navbar-right'><a href='./connection.php'><span style='margin-right:5px' class='glyphicon glyphicon-log-in'></span>Connexion</a></li>" .
                "<li class='" . inscriptionActive() . " navbar-right'><a href='./inscription.php'> <span style='margin-right:5px'; class='glyphicon glyphicon-user'></span>Inscription</a></li></ul>";
            }
            if (isset($_SESSION['connected'])) {
                echo "<ul class='nav navbar-nav'><li class='" . addcourseActive() . "'><a href='./addCourse.php'>Ajouter un cours</a></li></ul>" .
                "<ul class='nav navbar-nav navbar-right'><li><a href='./disconnect.php'>Déconnexion</a></li></ul>";
            }
            ?>
            </ul>
        </div>
</header>