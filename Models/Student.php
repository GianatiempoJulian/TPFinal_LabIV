<?php

namespace Models;
require_once ("Config/Autoload.php");

Class Student extends User{

    private $studentId;
    private $careerId;
    private $firstName;
    private $lastName;
    private $dni;
    private $fileNumber;
    private $gender;
    private $birthDate;
    private $email;
    private $phoneNumber;
    private $active;
   

    public function __construct(){}
}

?>