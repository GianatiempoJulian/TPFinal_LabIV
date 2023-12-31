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
          
        
            public function add(Company $company)
            {
                try {
                    $query = "INSERT INTO ".$this->tableName." (comp_id, comp_name, comp_type,comp_active,comp_email,comp_pass,comp_type_int) VALUES (:comp_id, :comp_name, :comp_type,:comp_active,:comp_email,:comp_pass,:comp_type_int);";
    
                    $parameters["comp_id"] = $company->getComp_id();
                    $parameters["comp_name"] = $company->getComp_name();
                    $parameters["comp_type"] = $company->getComp_type();
                    $parameters["comp_active"] = $company->getComp_active();
                    $parameters["comp_email"] = $company->getComp_email();
                    $parameters["comp_pass"] =  password_hash($company->getComp_pass(),PASSWORD_DEFAULT);
                    $parameters["comp_type_int"] = 2 ;// $company->getComp_type_int();

                  
    
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
                        $company->setComp_email($row["comp_email"]);
                        $company->setComp_pass($row["comp_pass"]);
                        $company->setComp_type_int($row["comp_type_int"]);
                       
    
    
                        array_push($companyList, $company);
    
                    }
                    return $companyList;
                }
                catch (Exception $ex){
                    throw $ex;
                }
            }

            public function remove($id)
            {

                try{
    
                    $query = "UPDATE $this->tableName SET comp_active = 0 WHERE comp_id = $id;";
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

            public function alta($id){

                try{
    
                    $query = "UPDATE $this->tableName SET comp_active = 1 WHERE comp_id = $id;";
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

            public function modify(Company $company)
            {

                try{
    
                    $query = "UPDATE $this->tableName SET comp_name = :comp_name , comp_type = :comp_type, comp_active = :comp_active   WHERE comp_id = :comp_id";
    
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

        
        public function getById($id)
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

        public function getByStatus($status)
        {
            try {
                $companyList = array();

                $query = " SELECT * FROM ".$this->tableName . " WHERE comp_active = " .$status;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $company = new Company();
                    $company->setComp_id($row["comp_id"]);
                    $company->setComp_name($row["comp_name"]);
                    $company->setComp_type($row["comp_type"]);
                    $company->setComp_active($row["comp_active"]);
                    $company->setComp_email($row["comp_email"]);
                    $company->setComp_pass($row["comp_pass"]);
                    $company->setComp_type_int($row["comp_type_int"]);
                    array_push($companyList, $company);

                }
                return $companyList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
       

        public function countCompanies()
        {
            $list = $this->GetAll();
            return count($list);
        }

        public function searchCompanyByName($comp_name)
        {
            $companyList = $this->GetAll();
            $company_found = null;

            foreach($companyList as $company)
            {
                if($company->getComp_name() == $comp_name)
                {
                    $company_found = $company;
                }
            }

            return $company_found;
        }
        
        public function searchCompanyByEmail($comp_email)
        {
            $companyList = $this->GetAll();
            $company_found = null;

            foreach($companyList as $company)
            {
                if($company->getComp_email() == $comp_email)
                {
                    $company_found = $company;
                }
            }

            return $company_found;
        }

                   
    }
?>