<?php

    namespace Models;

    class StudentXJobOffer
    {
        private $studentId;
        private $jobOfferId;

        public function __construct() {}

        /**
         * Get the value of studentId
         */ 
        public function getStudentId()
        {
                return $this->studentId;
        }

        /**
         * Set the value of studentId
         *
         * @return  self
         */ 
        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

                return $this;
        }

        /**
         * Get the value of jobOfferId
         */ 
        public function getJobOfferId()
        {
                return $this->jobOfferId;
        }

        /**
         * Set the value of jobOfferId
         *
         * @return  self
         */ 
        public function setJobOfferId($jobOfferId)
        {
                $this->jobOfferId = $jobOfferId;

                return $this;
        }
    }

?>