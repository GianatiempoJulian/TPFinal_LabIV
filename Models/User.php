<?php

namespace Models;

abstract class User
{
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;

    abstract protected function getId();
    abstract protected function setId($id);

    abstract protected function getFirstName();
    abstract protected function setFirstName($firstname);

    abstract protected function getLastName();
    abstract protected function setLastName($lastname);

    abstract protected function getEmail();
    abstract protected function setEmail($email);

    abstract protected function getPassword();
    abstract protected function setPassword($password);

}


?>