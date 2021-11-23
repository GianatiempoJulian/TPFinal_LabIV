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

                $query = "SELECT * FROM $this->tableName WHERE id_jobOffer = $id";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                        $studentXJob = new StudentXJobOffer();
                        $studentXJob->setStudentId($row["id_student"]);
                        $studentXJob->setJobOfferId($row["id_jobOffer"]);
    
                        array_push($sxjlist, $studentXJob);
                }

                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByUserId($id)
        {
            try
            {
                $sxjlist = array();

                $query = "SELECT * FROM $this->tableName WHERE id_usuario = $id";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach($resultSet as $row)
                {                
                    $studentXJob = new StudentXJobOffer();
                    $studentXJob->setStudentId($row["id_student"]);
                    $studentXJob->setJobOfferId($row["id_jobOffer"]);

                    array_push($sxjlist, $studentXJob);
                }

                return $sxjlist;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>