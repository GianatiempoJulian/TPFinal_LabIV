<?php

namespace Models;
//require_once ("Config/Autoload.php");

class User{

    private $mail;
    private $password;
    private $name;
    private $surname;
    private $city;

    public function __construct(){}

   

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }
}


?>