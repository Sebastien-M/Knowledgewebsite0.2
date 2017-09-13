<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auteur
 *
 * @author seb
 */
class Utilisateur {

    protected $nom;
    protected $email;
    protected $avatar;
    protected $bio;
    protected $age;
    protected $id;
    protected $password;
    
    function __construct($nom, $email, $avatar, $bio, $age, $id = NULL) {
        $this->nom = $nom;
        $this->email = $email;
        $this->avatar = $avatar;
        $this->bio = $bio;
        $this->age = $age;
        $this->id = $id;
    }

        /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAvatar() {
        return $this->avatar;
    }

    /**
     * @return mixed
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * @return mixed
     */
    public function getAge() {
        return $this->age;
    }

    
    function setPassword($password) {
        $this->password = $password;
    }
    
    function getPassword() {
        return $this->password;
    }



}