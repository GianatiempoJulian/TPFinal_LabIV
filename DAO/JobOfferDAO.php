<?php


    namespace DAO;

    require_once("Config/Autoload.php");
  
    use Config\Autoload as Autoload;
    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;
    use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;
  

    
    
    class JobOfferDAO implements IJobOfferDAO{

        private $connection;
        private $tableName = "job_offer";
      

        public function Add(JobOffer $jobOffer)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (o_id,o_idJobPosition, o_idCompany, o_fecha, o_description, o_active, o_image) VALUES ( :o_id,:o_idJobPosition, :o_idCompany, :o_fecha, :o_description, :o_active, :o_image);";

                $parameters["o_id"] = $jobOffer->getId();
                $parameters["o_idJobPosition"] = $jobOffer->getIdJobPosition();
                $parameters["o_idCompany"] = $jobOffer->getIdCompany();
                $parameters["o_fecha"] = $jobOffer->getFecha();
                $parameters["o_description"] = $jobOffer->getDescription();
                $parameters["o_active"] = $jobOffer->getActive();
                $parameters["o_image"] = $jobOffer->getImage();
               

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll()
        {
            try {

                $studentXJobDAO = new StudentXJobOfferDAO();
                $studentXJobList = $studentXJobDAO->GetAll();
                $jobOfferList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $userInJobList = array();
                    foreach($studentXJobList as $uxj)
                    {
                        if($uxj->getJobOfferId() == $row["o_id"])
                        {
                            array_push($userInJobList,$uxj->getStudentId());
                        }
                    }

                    $jobOffer = new JobOffer();
                    $jobOffer->setId($row["o_id"]);
                    $jobOffer->setIdJobPosition($row["o_idJobPosition"]);
                    $jobOffer->setIdCompany($row["o_idCompany"]);
                    $jobOffer->setFecha($row["o_fecha"]);
                    $jobOffer->setDescription($row["o_description"]);
                    $jobOffer->setActive($row["o_active"]);
                    $jobOffer->setImage($row["o_image"]);
                    $userInJobList = null;
                    array_push($jobOfferList, $jobOffer);
                }
                return $jobOfferList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id)
        {
            try{
                $query = "UPDATE $this->tableName SET o_active = 0 WHERE o_id = $id;";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }  
        }
        
        public function Alta($id)
        {
            try
            {
                $query = "UPDATE $this->tableName SET o_active = 1 WHERE o_id = $id;";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function last()
        {
            try
            {
                $query = "SELECT last_insert_id() from $this->tableName";
                $this->connection = Connection::GetInstance();
                $last =  $this->connection->ExecuteNonQuery($query);
                return $last;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Modify(JobOffer $jobOffer)
        {
            try
            {
                $query = "UPDATE $this->tableName SET o_idJobPosition = :o_idJobPosition , o_idCompany = :o_idCompany, o_fecha = :o_fecha, o_description = :o_description, o_active = :o_active, o_image = :o_image   WHERE o_id = :o_id";
                $parameters["o_id"] = $jobOffer->getId();
                $parameters["o_idJobPosition"] = $jobOffer->getIdJobPosition();
                $parameters["o_idCompany"] = $jobOffer->getIdCompany();
                $parameters["o_fecha"] = $jobOffer->getFecha();
                $parameters["o_description"] = $jobOffer->getDescription();
                $parameters["o_active"] = $jobOffer->getActive();
                $parameters["o_image"] = $jobOffer->getImage();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function CountOffers()
        {
            $list = $this->GetAll();
            return count($list);
        }

        public function SearchOfferById ($o_id)
        {
            try
            {
                $jobOffer = new JobOffer();
                $query = " SELECT * FROM ".$this->tableName . " WHERE o_id = " .$o_id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row)
                {
                    $jobOffer->setId($row["o_id"]);
                    $jobOffer->setIdJobPosition($row["o_idJobPosition"]);
                    $jobOffer->setIdCompany($row["o_idCompany"]);
                    $jobOffer->setFecha($row["o_fecha"]);
                    $jobOffer->setDescription($row["o_description"]);
                    $jobOffer->setActive($row["o_active"]);
                    $jobOffer->setImage($row["o_image"]);

                }
                return $jobOffer;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByStatus($status)
        {
            try {
                $jobOfferList = array();
                $query = " SELECT * FROM ".$this->tableName . " WHERE o_active = " .$status;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setId($row["o_id"]);
                    $jobOffer->setIdJobPosition($row["o_idJobPosition"]);
                    $jobOffer->setIdCompany($row["o_idCompany"]);
                    $jobOffer->setFecha($row["o_fecha"]);
                    $jobOffer->setDescription($row["o_description"]);
                    $jobOffer->setActive($row["o_active"]);
                    $jobOffer->setImage($row["o_image"]);
                    array_push($jobOfferList, $jobOffer);
                }
                return $jobOfferList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
    }
?>