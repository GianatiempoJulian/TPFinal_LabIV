<?php


    namespace DAO;

    require_once("Config/Autoload.php");
  
    use Config\Autoload as Autoload;
    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;
  
   
    
    
    class JobOfferDAO implements IJobOfferDAO{

        private $connection;
        private $tableName = "job_offer";
      

        public function Add(JobOffer $jobOffer){
            try {
                $query = "INSERT INTO ".$this->tableName." (id, idJobPosition, idCompany, fecha, description, active, users) VALUES (:id, :idJobPosition, :idCompany, :fecha, :description, :active, :users);";

                $parameters["id"] = $jobOffer->getId();
                $parameters["idJobPosition"] = $jobOffer->getIdJobPosition();
                $parameters["idCompany"] = $jobOffer->getIdCompany();
                $parameters["fecha"] = $jobOffer->getFecha();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["active"] = $jobOffer->getActive();
                //$parameters["users"] = $jobOffer->getUsers();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $jobOfferList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $jobOffer = new JobOffer();
                    $jobOffer->setId($row["id"]);
                    $jobOffer->setIdJobPosition($row["idJobPosition"]);
                    $jobOffer->setIdCompany($row["idCompany"]);
                    $jobOffer->setFecha($row["fecha"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setActive($row["active"]);
                    $jobOffer->setUsers($row["users"]);
                    


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