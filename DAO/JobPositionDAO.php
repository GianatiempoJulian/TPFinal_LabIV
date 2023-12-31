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
      

        public function add(JobPosition $jobPosition)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (p_id, p_careerId, p_description) VALUES (:p_id, :p_careerId, :p_description);";
                $parameters["p_id"] = $jobPosition->getId();
                $parameters["p_careerId"] = $jobPosition->getCarrerId();
                $parameters["p_description"] = $jobPosition->getDescription();
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
                $jobPositionList = array();
                $query = " SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $jobPosition = new JobPosition();
                    $jobPosition->setId($row["p_id"]);
                    $jobPosition->setCarrerId($row["p_careerId"]);
                    $jobPosition->setDescription($row["p_description"]);
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