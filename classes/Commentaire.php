<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commentaire
 *
 * @author seb
 */
class Commentaire {
    
    protected $auteur;
    protected $commentaire;
    protected $date;
    protected $idarticle;

    function __construct( $auteur, $commentaire,$idarticle) {
        $this->auteur = $auteur;
        $this->commentaire = $commentaire;
        $this->date = date("Y-m-d");
        $this->idarticle=$idarticle;
    }

    function getAuteur() {
        return $this->auteur;
    }

    function getCommentaire() {
        return $this->commentaire;
    }

    function getDate() {
        return $this->date;
    }

    function getidarticle() {
        return $this->idarticle;
    }


}
