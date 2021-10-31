<?php

    namespace Models;

    class JobOffer
    {
        private $id;
        private $idJobPosition;
        private $idCompany;
        private $fecha;
        private $description;
        private $active;
        private $users = array();

        public function __construct(){}

        

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of idJobPosition
         */ 
        public function getIdJobPosition()
        {
                return $this->idJobPosition;
        }

        /**
         * Set the value of idJobPosition
         *
         * @return  self
         */ 
        public function setIdJobPosition($idJobPosition)
        {
                $this->idJobPosition = $idJobPosition;

                return $this;
        }

        /**
         * Get the value of idCompany
         */ 
        public function getIdCompany()
        {
                return $this->idCompany;
        }

        /**
         * Set the value of idCompany
         *
         * @return  self
         */ 
        public function setIdCompany($idCompany)
        {
                $this->idCompany = $idCompany;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

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
         * Get the value of users
         */ 
        public function getUsers()
        {
                return $this->users;
        }

        /**
         * Set the value of users
         *
         * @return  self
         */ 
        public function setUsers($users)
        {
                $this->users = $users;

                return $this;
        }
    }
?>