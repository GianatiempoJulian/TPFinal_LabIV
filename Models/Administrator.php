<?php

namespace Models;

require_once ("Config/Autoload.php");

use Config\Autoload as Autoload;
use Models\User as User;

Autoload::Start();

Class Administrator extends User{

    private $idAdministrator;

    public function __construct(){}

    /**
     * Get the value of idAdministrator
     */ 
    public function getIdAdministrator()
    {
        return $this->idAdministrator;
    }

    /**
     * Set the value of idAdministrator
     *
     * @return  self
     */ 
    public function setIdAdministrator($idAdministrator)
    {
        $this->idAdministrator = $idAdministrator;

        return $this;
    }
}


?>