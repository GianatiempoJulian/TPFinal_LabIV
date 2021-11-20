<?php


namespace Models;



Class Company{

    private $comp_id;
    private $comp_name;
    private $comp_type;
    private $comp_active;
    private $comp_email;
    private $comp_pas;
    private $comp_type_int;



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

    /**
     * Get the value of comp_active
     */ 
    public function getComp_active()
    {
        return $this->comp_active;
    }

    /**
     * Set the value of comp_active
     *
     * @return  self
     */ 
    public function setComp_active($comp_active)
    {
        $this->comp_active = $comp_active;

        return $this;
    }

    public function getComp_email(){
        return $this->comp_email;
    }

    public function getComp_pass(){
        return $this->comp_pass;
    }
    public function setComp_email($comp_email)
    {
        $this->comp_email = $comp_email;

        return $this;
    }
    public function setComp_pass($comp_pass)
    {
        $this->comp_pass = $comp_pass;

        return $this;
    }

    /**
     * Get the value of comp_type_int
     */ 
    public function getComp_type_int()
    {
        return $this->comp_type_int;
    }

    /**
     * Set the value of comp_type_int
     *
     * @return  self
     */ 
    public function setComp_type_int($comp_type_int)
    {
        $this->comp_type_int = $comp_type_int;

        return $this;
    }
}

?>