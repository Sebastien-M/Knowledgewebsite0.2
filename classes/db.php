<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class managing all database usages
 *
 * @author seb
 */
include_once 'Utilisateur.php';
include_once 'Article.php';
include_once 'Commentaire.php';

class db {

    private $dbh;

    function __construct() {
        $this->dbh = new PDO('mysql:host=localhost;dbname=knowledge_websitedb', 'root', 'PASS');
        //$this->dbh->setAttr$this->dbh = new PDO('mysql:host=localhost;dbname=knoibute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * new user
     *
     * creates a new user
     *
     * @param Class Utilisateur User class
     * @return (none) (none)
     * 
     */
    function new_user(Utilisateur $user) {
        $query = $this->dbh->prepare("INSERT INTO users (pseudo, password, email, reg_date) " .
                "VALUES (:pseudo, :password, :email, :reg_date);");
        $query->bindValue(':pseudo', $user->getNom());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':reg_date', 'NOW()');
        $query->execute();
        return TRUE;
    }

    /**
     * newArticle
     *
     * creates a new article
     *
     * @param (Class) (Article) Article Class
     * @return (none) 
     * 
     */
    function newArticle(Article $cours) {
        $query = $this->dbh->prepare("INSERT INTO articles (discipline, titre, contenu, auteur, creation_date) "
                . "VALUES (:discipline,:titre, :contenu, :auteur, :creation_date);");
        $query->bindValue('discipline', $cours->getDiscipline());
        $query->bindValue('titre', $cours->getTitre());
        $query->bindValue('contenu', $cours->getContenu());
        $query->bindValue('auteur', $cours->getAuteur());
        $query->bindValue('creation_date', $cours->getDate());
        $query->execute();
        return TRUE;
    }

    /**
     * connect
     *
     * check if pseudo and password matches with an existing one
     *
     * @param (str,str) $user,$password pseudo and password sent inside inputs
     * @return (Bool) (True if connection is okay)
     * 
     */
    function connect($user, $password) {
        $verif_login = $this->dbh->query("SELECT COUNT(*) FROM users WHERE pseudo = '" . $user . "';");
        if ($verif_login->fetchColumn() == 0) {
            //Pseudo inexistant
        } else {
            $reponse_login = $this->dbh->query("SELECT password FROM users WHERE pseudo ='" . $user . "' LIMIT 1;");
            $donnees = $reponse_login->fetch();
            $passresult = password_verify($password, $donnees['password']);
            if ($passresult == TRUE) {
                return TRUE;
            }
        }
    }

    /**
     * readArticles
     *
     * display articles
     *
     * @param none
     * @return (associative array) (Associative array containing discipline, titre, contenu, auteur and creation date)
     * 
     */
    function readArticles() {
        $arr = [];
        $query = $this->dbh->query("SELECT * FROM articles");
//        if (!$query) {
//            echo "\nPDO::errorInfo():\n";
//            print_r($this->dbh->errorInfo());
//        }
        while ($row = $query->fetch()) {
            $arr[$row['id']]["discipline"] = $row['discipline'];
            $arr[$row['id']]["titre"] = $row['titre'];
            $arr[$row['id']]["contenu"] = $row['contenu'];
            $arr[$row['id']]["auteur"] = $row['auteur'];
            $arr[$row['id']]["creation"] = $row['creation_date'];
        }
        return $arr;
    }

    /**
     * readSingleArticle
     *
     * Display content of an article
     *
     * @param str $chosen Title of article
     * @return (array) (Array containing discipline, titre, contenu, auteur and creation date)
     * 
     */
    function readSingleArticle($chosen): array {
        $arr = [];
        $query = $this->dbh->query("SELECT * FROM articles where titre='".$chosen."' LIMIT 1;");
//        if (!$query) {
//            echo "\nPDO::errorInfo():\n";
//            print_r($this->dbh->errorInfo());
//        }
        while ($row = $query->fetch()) {
            $arr['id'] = $row['id'];
            $arr['discipline'] = $row['discipline'];
            $arr['titre'] = $row['titre'];
            $arr['contenu'] = $row['contenu'];
            $arr['auteur'] = $row['auteur'];
            $arr['creation'] = $row['creation_date'];
        }
        return $arr;
    }

    function newComment(Commentaire $comment) {
        $query = $this->dbh->prepare("INSERT INTO commentaires (auteur,commentaire,postdate,idarticle) VALUES ("
                . ":auteur, :commentaire, :postdate, :idarticle)");
        $query->bindValue(':auteur', $comment->getAuteur());
        $query->bindValue(':commentaire', $comment->getCommentaire());
        $query->bindValue(':postdate', $comment->getDate());
        $query->bindValue(':idarticle', $comment->getidarticle());
        $query->execute();
        return TRUE;
    }

    function readComments($idarticle) {
        $commentaires = [];
        $i = 0;
        $query = $this->dbh->prepare("SELECT * FROM commentaires WHERE idarticle=:idarticle");
        $query->bindValue(':idarticle', $idarticle);
        $query->execute();
        while ($row = $query->fetch()) {
            $commentaires[$i]['id'] = $row['id'];
            $commentaires[$i]['auteur'] = $row['auteur'];
            $commentaires[$i]['commentaire'] = $row['commentaire'];
            $commentaires[$i]['date'] = $row['postdate'];
            $commentaires[$i]['idarticle'] = $row['idarticle'];
            $i += 1;
        }
        return $commentaires;
    }

    function deletecomment($commentid) {
        $query = $this->dbh->prepare("DELETE FROM commentaires WHERE id = :commentid");
        $query->bindValue(':commentid', $commentid);
        $query->execute();
        return TRUE;
    }

    function deletearticle($articleid) {
        $deletecomment = $this->dbh->prepare("DELETE FROM commentaires WHERE idarticle = :articleid");
        $deletecomment->bindValue(':articleid', $articleid);
        $deletecomment->execute();
        $deletearticle = $this->dbh->prepare("DELETE FROM articles WHERE id = :id");
        $deletearticle->bindValue(':id', $articleid);
        $deletearticle->execute();
        return TRUE;
    }

}
