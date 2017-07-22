<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Articles
 *
 * @author seb
 */
class Article {

    protected $discipline;
    protected $titre;
    protected $contenu;
    protected $upvotes = [];
    protected $downvotes = [];
//    protected $date;
    protected $auteur;
    protected $tags;
    protected $commentaires = [];
    protected $id;

    function __construct($discipline, $titre, $contenu, $auteur) {
        $this->discipline = $discipline;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->auteur = $auteur;
        $this->id = rand(0, 1000000);
    }

    function makeArticle() {
        echo "<div class='article'>";
        echo "<p>" . $this->titre . "</p>";
        echo "<p>" . $this->contenu . "</p>";
        echo "<p>" . $this->auteur . "</p>";
        echo "<p>" . $this->date . "</p>";
        echo "<p>" . $this->discipline . "</p>";
        echo "<p>" . $this->tags . "</p>";
        echo "<p>" . $this->upvotes . "</p>";
        echo "</div>";
    }

    function getDiscipline() {
        return $this->discipline;
    }

    function getTitre() {
        return $this->titre;
    }

    function getContenu() {
        return $this->contenu;
    }


    function getDate() {
        return $this->date;
    }

    function getAuteur() {
        return $this->auteur;
    }

    function getTags() {
        return $this->tags;
    }

    function getCommentaires() {
        return $this->commentaires;
    }

    function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
    }
    function getId() {
        return $this->id;
    }

    function getUpvotes() {
        return $this->upvotes;
    }

    function getDownvotes() {
        return $this->downvotes;
    }

    function setUpvotes($upvotes) {
        $this->upvotes = $upvotes;
    }

    function setDownvotes($downvotes) {
        $this->downvotes = $downvotes;
    }




}
