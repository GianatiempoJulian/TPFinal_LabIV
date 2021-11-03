<?php


    namespace DAO;

    require_once("Config/Autoload.php");
  
    use Config\Autoload as Autoload;
    use \Exception as Exception;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;
    use DAO\Connection as Connection;
  
   
    
    
    class JobPositionDAO implements IJobPositionDAO{

        private $connection;
        private $tableName = "job_position";
      

        public function Add(JobPosition $jobPosition){
            try {
                $query = "INSERT INTO ".$this->tableName." (id, carrerId, description) VALUES (:id, :carrerId, :description);";

                $parameters["id"] = $jobPosition->getId();
                $parameters["carrerId"] = $jobPosition->getCarrerId();
                $parameters["description"] = $jobPosition->getDescription();
        

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $jobPositionList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $jobPosition = new JobPosition();
                    $jobPosition->setId($row["id"]);
                    $jobPosition->setCarrerId($row["carrerId"]);
                    $jobPosition->setDescription($row["description"]);
                    


                    array_push($jobPositionList, $jobPosition);

                }
                return $jobPositionList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
    }
?>