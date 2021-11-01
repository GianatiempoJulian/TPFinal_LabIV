<?php
    
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career; 
    use \Exception as Exception;
    use DAO\Connection as Connection;
  
    require_once("ICareerDAO.php");
    
    Class CareerDAO implements ICareerDAO{
        private $connection;
        private $tableName = "careers";
      
    
        public function Add(Career $career){
            try {
                $query = "INSERT INTO ".$this->tableName." (careerId, carrer_description, active) VALUES (:careerId, :carrer_description, :active);";

                $parameters["careerId"] = $career->getCareerId();
                $parameters["carrer_description"] = $career->getcarrer_description();
                $parameters["active"] = $career->getActive();
              

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $careerList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $career = new Career();
                    $career->setCareerId($row["careerId"]);
                    $career->setcarrer_description($row["carrer_description"]);
                    $career->setActive($row["active"]);
                   


                    array_push($careerList, $career);

                }
                return $careerList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }



        /*

        public function Remove($career_id){

            $this->retrieveData();
		    $newList = array();

		    foreach ($this->careerList as $career) {
			    if($career->getCareerId()!= $career_id){
				    array_push($newList, $career);
			    }
		}

		$this->researchList = $newList;
		$this->saveData();
        }

    

        public function GetAll(){
            $this->RetrieveData();
            return $this->careerList;
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach($this->careerList as $career){
                $valuesArray["careerId"] = $career->getCareerId();
                $valuesArray["carrer_description"] = $career->getcarrer_description();
                $valuesArray["active"] = $career->getActive();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function RetrieveData(){

            $this->careerList = array();
      

                $opt = array(
                    "http" => array(
                    "method" => "GET",
                    "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
                    )
                );
            
                $ctx = stream_context_create($opt);
            
                $jsonContent = file_get_contents("https://utn-students-api.herokuapp.com/api/Career", false, $ctx);
            
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
    
                foreach($arrayToDecode as $valuesArray){

                   
                    $career = new Career();
                    $career->setCareerId($valuesArray["careerId"]);
                    $career->setcarrer_description($valuesArray["carrer_description"]) ;
                    $career->setActive($valuesArray["active"]);
                    array_push($this->careerList,$career);
               
            }
        }*/
    }
?>