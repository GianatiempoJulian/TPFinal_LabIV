<?php

    namespace DAO;

    
    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use \Exception as Exception;
    use DAO\Connection as Connection;
   
    Autoload::Start();

    Class CompanyDAO /*implements ICompanyDAO*/{    
        private $connection;
        private $tableName = "companies";
          
        
            public function Add(Company $company){
                try {
                    $query = "INSERT INTO ".$this->tableName." (comp_id, comp_name, comp_type) VALUES (:comp_id, :comp_name, :comp_type);";
    
                    $parameters["comp_id"] = $company->getComp_id();
                    $parameters["comp_name"] = $company->getComp_name();
                    $parameters["comp_type"] = $company->getComp_type();
                  
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
                }
                catch(Exception $ex){
                    throw $ex;
                }
            }
    
            public function GetAll(){
                try {
                    $companyList = array();
    
                    $query = " SELECT * FROM ".$this->tableName;
    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
    
                    foreach ($resultSet as $row){
    
                        $company = new Company();
                        $company->setComp_id($row["comp_id"]);
                        $company->setComp_name($row["comp_name"]);
                        $company->setComp_type($row["comp_type"]);
                       
    
    
                        array_push($companyList, $company);
    
                    }
                    return $companyList;
                }
                catch (Exception $ex){
                    throw $ex;
                }
            }
    
      
        /*
        public function Add(Company $company){
            $this->RetrieveData();
            array_push($this->companyList,$company);
            $this->SaveData();
        }

        public function Remove($comp_id){

            $this->RetrieveData();
		    $newList = array();

		    foreach ($this->companyList as $company) {
			    if($company->getComp_id()!= $comp_id){
				    array_push($newList, $company);
			    }
		}

		$this->companyList = $newList;
		$this->SaveData();
       
        }

        public function ModifyName($comp_id,$dato){

            $this->RetrieveData();
		   

		    foreach ($this->companyList as $company) {
			    if($company->getComp_id()== $comp_id){
                    $company->setComp_name($dato);
			    }
		}

		
		$this->SaveData();
       
        }

        public function ModifyType($comp_id,$dato){

            $this->RetrieveData();
		   
            echo "el valor de dato es" . $dato;
		    foreach ($this->companyList as $company) {
			    if($company->getComp_id()== $comp_id){
                    $company->setComp_type($dato);
			    }
		}

		
		$this->SaveData();
       
        }

        

        
        

        

        public function GetAll(){
            $this->RetrieveData();
            return $this->companyList;
        }

        public function GetById($id){
            
            $this->RetrieveData();
            $aux = new Company();
            foreach($this->companyList as $company)
            {
                if ($company->getComp_id() == $id)
                {
                    $aux = $company;
                }
            }
            return $aux;
        }

        public function SearchCompanyByName($name)
        {
            $this->RetrieveData();
            $company_found = null;

            foreach($this->companyList as $company)
            {
                if($company->getComp_name() == $name)
                {
                    $company_found = $company;
                }
            }

            return $company_found;
        }


        public function CountCompanies()
        {
            $this->RetrieveData();

            return count($this->companyList);
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach($this->companyList as $company){
                $valuesArray["companyId"] = $company->getComp_id();
                $valuesArray["companyName"] = $company->getComp_name();
                $valuesArray["companyType"] = $company->getComp_type();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function RetrieveData(){
            $this->companyList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $company = new Company();
                    $company->setComp_id($valuesArray["companyId"]);
                    $company->setComp_name($valuesArray["companyName"]);
                    $company->setComp_type($valuesArray["companyType"]);
                    array_push($this->companyList,$company);
                }
            }
        }*/

                   
    }
?>