<?php

namespace Models;
require_once ("Config/Autoload.php");

use Config\Autoload as Autoload;
use Models\User as User;

Autoload::Start();

Class Employer extends User{

    private $company;
    private $charge;

    public function __construct(){}
}


?>