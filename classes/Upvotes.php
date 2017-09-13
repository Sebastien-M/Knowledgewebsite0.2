<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upvotes
 *
 * @author seb
 */
class Upvotes {
    protected $article;
    protected $author;
    protected $nb;
    protected $max = 1;
            
    function __construct($article, $author, $nb) {
        $this->article = $article;
        $this->author = $author;
        $this->nb = $nb;
    }

}
