<?php

    namespace DAO;
    
    use \Exception as Exception;
    use Models\StudentXJobOffer;

    class StudentXJobOfferDAO
    {
        private $connection;
        private $tableName = "STUDENT_X_JOB_OFFER";

        public function Add(StudentXJobOffer $studentXJob)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (recordId, o_id) VALUES (:recordId, :o_id)";
                $parameters["recordId"] = $studentXJob->getStudentId();
                $parameters["o_id"] = $studentXJob->getJobOfferId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
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
                    $studentXJob->setStudentId($row["recordId"]);
                    $studentXJob->setJobOfferId($row["o_id"]);
                    array_push($sxjlist, $studentXJob);
                }
                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
        public function GetByJobOfferId($id)
        {
            try
            {
                $sxjlist = array();
                $query = "SELECT * FROM $this->tableName WHERE o_id = $id";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["recordId"]);
                    $studentXJob->setJobOfferId($row["o_id"]);
                    array_push($sxjlist, $studentXJob);
                }
                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByStudentId($id)
        {
            try
            {
                $sxjlist = array();
                $query = "SELECT * FROM $this->tableName WHERE recordId = $id";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["recordId"]);
                    $studentXJob->setJobOfferId($row["o_id"]);
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
                $query = "SELECT * FROM $this->tableName WHERE recordId = $studentId AND o_id = $joId";
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

        public function Remove($studentId, $joId)
            {
                try
                {
                    $query = "DELETE from $this->tableName WHERE recordId = $studentId AND o_id = $joId";
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

    }
?>