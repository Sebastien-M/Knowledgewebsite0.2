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
        <title></title>
    </head>
    <body>
        <?php
        session_destroy();
        ?>
        <p>Déconnexion</p>
        <script>
            document.location.href="index.php";
        </script>
    </body>
</html>
