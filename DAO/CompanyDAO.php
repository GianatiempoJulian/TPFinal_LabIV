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
                    $query = "INSERT INTO ".$this->tableName." (comp_id, comp_name, comp_type,comp_active) VALUES (:comp_id, :comp_name, :comp_type,:comp_active);";
    
                    $parameters["comp_id"] = $company->getComp_id();
                    $parameters["comp_name"] = $company->getComp_name();
                    $parameters["comp_type"] = $company->getComp_type();
                    $parameters["comp_active"] = $company->getComp_active();
                  
    
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
                        $company->setComp_active($row["comp_active"]);
                       
    
    
                        array_push($companyList, $company);
    
                    }
                    return $companyList;
                }
                catch (Exception $ex){
                    throw $ex;
                }
            }

            public function Remove($id){

                try{
    
                    $query = "UPDATE $this->tableName SET comp_active = 0 WHERE comp_id = $id;";
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

            public function Alta($id){

                try{
    
                    $query = "UPDATE $this->tableName SET comp_active = 1 WHERE comp_id = $id;";
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

        
        public function GetById($id)
        {
            $companyList = $this->GetAll();
            $company_aux = new Company();

            foreach($companyList as $company)
            {
                if($company->getComp_id() == $id)
                {
                    
                    $company_aux = $company;
                }
            }
            return $company_aux;
        }
       

        public function CountCompanies(){

            $list = $this->GetAll();
            return count($list);
        }

        public function SearchCompanyByName($name)
        {
            $companyList = $this->GetAll();
            $company_found = null;

            foreach($companyList as $company)
            {
                if($company->getComp_name() == $name)
                {
                    $company_found = $company;
                }
            }

            return $company_found;
        }

                   
    }
?>