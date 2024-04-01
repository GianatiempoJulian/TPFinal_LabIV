<?php

    namespace DAO;
    
    use \Exception as Exception;
    use Models\StudentXJobOffer;

    class StudentXJobOfferDAO
    {
        private $connection;
        private $tableName = "student_x_job_offer";

        public function add(StudentXJobOffer $studentXJob)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId, jobOfferId) VALUES (:studentId, :jobOfferId)";
                $parameters["studentId"] = $studentXJob->getStudentId();
                $parameters["jobOfferId"] = $studentXJob->getJobOfferId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $sxjlist = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["studentId"]);
                    $studentXJob->setJobOfferId($row["jobOfferId"]);
                    array_push($sxjlist, $studentXJob);
                }
                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
        public function getByJobOfferId($id)
        {
            try
            {
                $sxjlist = array();
                $query = "SELECT * FROM $this->tableName WHERE jobOfferId = $id";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["studentId"]);
                    $studentXJob->setJobOfferId($row["jobOfferId"]);
                    array_push($sxjlist, $studentXJob);
                }
                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByStudentId($id)
        {
            try
            {
                $sxjlist = array();
                $query = "SELECT * FROM $this->tableName WHERE studentId = $id";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["studentId"]);
                    $studentXJob->setJobOfferId($row["jobOfferId"]);
                    array_push($sxjlist, $studentXJob);
                }
                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function isPostuled($studentId, $joId)
        {
            try
            {
                $query = "SELECT * FROM $this->tableName WHERE studentId = $studentId AND jobOfferId = $joId";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                if($resultSet)
                {
                    return true;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($studentId, $joId)
            {
                try
                {
                    $query = "DELETE FROM "  .$this->tableName. " WHERE studentId=" .$studentId. " AND jobOfferId=" .$joId;
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

    }
?>