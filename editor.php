<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>A Simple Page with CKEditor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
    </head>
    <body>
        <form action='' method="POST">
            <textarea name="editor1" id="editor1" rows="20" cols="80">
                Ecrivez votre cours ici
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
            </script>
            <input type="submit" value='envoyer'>
        </form>
        <?php
        if(isset($_POST['editor1'])){
            echo $_POST['editor1'];
        }
        ?>
    </body>
</html>
