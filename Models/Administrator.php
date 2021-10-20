<?php

namespace Models;
//require_once ("Config/Autoload.php");
require_once("User.php");
use Models\User as User;

Class Administrator extends User{

    private $idAdministrator;

    public function __construct(){}
}


?>