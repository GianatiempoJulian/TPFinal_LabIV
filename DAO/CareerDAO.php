<?php
    
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career; 
    use \Exception as Exception;
    use DAO\Connection as Connection;
  
    require_once("ICareerDAO.php");
    
    Class CareerDAO /*implements ICareerDAO*/
    {
        private $connection;
        private $tableName = "careers";
      
    
        public function add(Career $career)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (id, description, active) VALUES (:id, :description, :active);";

                $parameters["id"] = $career->getid();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();
              

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
                $careerList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $career = new Career();
                    $career->setId($row["id"]);
                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);
                    array_push($careerList, $career);
                }
                return $careerList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
        
       
    }
?>