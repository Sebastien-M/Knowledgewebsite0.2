<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="./index.php">Knowledge Website</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="<?php
                    if ($_SERVER['PHP_SELF'] === "/projets/Knowledgewebsite0.2/index.php") {
                        echo "active";
                    }
                    ?>"><a href="./index.php">Cours</a></li>
                        <?php
                        if (isset($_SESSION['connected'])) {
                            echo "<li class='" . addcourseActive() . "'><a href='./addCourse.php'>Ajouter un cours</a></li>";
                        }
                        ?>
                </ul>

                <!--Right icons-->
                <ul class="nav navbar-nav navbar-right">
                    <?php

                    function connectionActive() {
                        if ($_SERVER['PHP_SELF'] === "/projets/Knowledgewebsite0.2/connection.php") {
                            return "active";
                        }
                    }

                    function inscriptionActive() {
                        if ($_SERVER['PHP_SELF'] === "/projets/Knowledgewebsite0.2/inscription.php") {
                            return "active";
                        }
                    }

                    function addcourseActive() {
                        if ($_SERVER['PHP_SELF'] === "/projets/Knowledgewebsite0.2/addCourse.php") {
                            return "active";
                        }
                    }

                    if (!isset($_SESSION['connected'])) {
                        echo "<li class='" . connectionActive() . " navbar-right'><a href='./connection.php'><span style='margin-right:5px' class='glyphicon glyphicon-log-in'></span>Connexion</a></li>" .
                        "<li class='" . inscriptionActive() . " navbar-right'><a href='./inscription.php'> <span style='margin-right:5px' class='glyphicon glyphicon-user'></span>Inscription</a></li>";
                    }
                    if (isset($_SESSION['connected'])) {
                        echo "<ul class='nav navbar-nav navbar-right'><li><a href='./disconnect.php'>Déconnexion</a></li></ul>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>