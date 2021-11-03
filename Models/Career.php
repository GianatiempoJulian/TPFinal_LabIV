<?php


namespace Models;


Class Career {
    private $careerId;
    private $carrer_description;
    private $active;

    /**
     * Get the value of careerId
     */ 
    public function getCareerId()
    {
        return $this->careerId;
    }

    /**
     * Set the value of careerId
     *
     * @return  self
     */ 
    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;

        return $this;
    }

    

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of carrer_description
     */ 
    public function getCarrer_description()
    {
        return $this->carrer_description;
    }

    /**
     * Set the value of carrer_description
     *
     * @return  self
     */ 
    public function setCarrer_description($carrer_description)
    {
        $this->carrer_description = $carrer_description;

        return $this;
    }
}
?>