<?php


namespace Models;

//require_once ("Config/Autoload.php");

//Use Autoload as Autoload;

//Autoload::Start();

Class Company{

    private $comp_id;
    private $comp_name;
    private $comp_type;


    ///CONSTRUCTOR
    
    public function __construct(){}

    

    ///GETTERS & SETTERS

    /**
     * Get the value of comp_name
     */ 
    public function getComp_name()
    {
        return $this->comp_name;
    }

    /**
     * Set the value of comp_name
     *
     * @return  self
     */ 
    public function setComp_name($comp_name)
    {
        $this->comp_name = $comp_name;

        return $this;
    }

    /**
     * Get the value of comp_id
     */ 
    public function getComp_id()
    {
        return $this->comp_id;
    }

    /**
     * Set the value of comp_id
     *
     * @return  self
     */ 
    public function setComp_id($comp_id)
    {
        $this->comp_id = $comp_id;

        return $this;
    }

    /**
     * Get the value of comp_type
     */ 
    public function getComp_type()
    {
        return $this->comp_type;
    }

    /**
     * Set the value of comp_type
     *
     * @return  self
     */ 
    public function setComp_type($comp_type)
    {
        $this->comp_type = $comp_type;

        return $this;
    }
}

?>