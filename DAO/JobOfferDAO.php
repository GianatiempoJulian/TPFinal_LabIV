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
        private $tableName = "job_offers";
      

        public function add(JobOffer $jobOffer)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (id,jobPositionId, companyId, date, description, active, image) VALUES ( :id,:jobPositionId, :companyId, :date, :description, :active, :image);";

                $parameters["id"] = $jobOffer->getId();
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["date"] = $jobOffer->getDate();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["active"] = $jobOffer->getActive();
                $parameters["image"] = $jobOffer->getImage();
               

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function getAll()
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
                        if($uxj->getJobOfferId() == $row["id"])
                        {
                            array_push($userInJobList,$uxj->getStudentId());
                        }
                    }

                    $jobOffer = new JobOffer();
                    $jobOffer->setId($row["id"]);
                    $jobOffer->setjobPositionId($row["jobPositionId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setDate($row["date"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setActive($row["active"]);
                    $jobOffer->setImage($row["image"]);
                    $userInJobList = null;
                    array_push($jobOfferList, $jobOffer);
                }
                return $jobOfferList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }

        public function remove($id)
        {
            try{
                $query = "UPDATE $this->tableName SET active = 0 WHERE id = $id;";
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
                $query = "SELECT MAX(id) FROM JOB_OFFERS";
                $this->connection = Connection::GetInstance();
                $last =  $this->connection->Execute($query);
                return $last[0]["MAX(id)"];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(JobOffer $jobOffer)
        {
            try
            {
                $query = "UPDATE $this->tableName SET jobPositionId = :jobPositionId , companyId = :companyId, date = :date, description = :description, active = :active, image = :image  WHERE id = :id";
                $parameters["id"] = $jobOffer->getId();
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["date"] = $jobOffer->getDate();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["active"] = $jobOffer->getActive();
                $parameters["image"] = $jobOffer->getImage();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByID ($id)
        {
            try
            {
                $jobOffer = new JobOffer();
                $query = " SELECT * FROM ".$this->tableName . " WHERE id = " .$id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row)
                {
                    $jobOffer->setId($row["id"]);
                    $jobOffer->setJobPositionId($row["jobPositionId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setDate($row["date"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setActive($row["active"]);
                    $jobOffer->setImage($row["image"]);

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
                $query = " SELECT * FROM ".$this->tableName . " WHERE active = " .$status;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setId($row["id"]);
                    $jobOffer->setJobPositionId($row["jobPositionId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setdate($row["date"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setActive($row["active"]);
                    $jobOffer->setImage($row["image"]);
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