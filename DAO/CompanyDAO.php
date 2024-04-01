<?php

    namespace DAO;

    
    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use \Exception as Exception;
    use DAO\Connection as Connection;
   
    Autoload::Start();

    Class CompanyDAO 
    {    
        private $connection;
        private $tableName = "companies";
          
        
            public function add(Company $company)
            {
                try {
                    $query = "INSERT INTO ".$this->tableName." (id, name, type,active,email,password) VALUES (:id, :name, :type,:active,:email,:password);";
                    $parameters["id"] = $company->getId();
                    $parameters["name"] = $company->getName();
                    $parameters["type"] = $company->getType();
                    $parameters["active"] = $company->getActive();
                    $parameters["email"] = $company->getEmail();
                    $parameters["password"] =  password_hash($company->getPassword(),PASSWORD_DEFAULT);

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
                        $company->setId($row["id"]);
                        $company->setName($row["name"]);
                        $company->setType($row["type"]);
                        $company->setActive($row["active"]);
                        $company->setEmail($row["email"]);
                        $company->setPassword($row["password"]);

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
                try
                {
                    $query = "DELETE FROM " .$this->tableName. " WHERE id=" .$id;
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }

            public function modify(Company $company)
            {

                try{
    
                    $query = "UPDATE $this->tableName SET name = :name , type = :type, active = :active   WHERE id = :id";
    
                    $parameters["id"] = $company->getId();
                    $parameters["name"] = $company->getName();
                    $parameters["type"] = $company->getType();
                    $parameters["active"] = $company->getActive();
                  
    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                catch(Exception $ex){
    
                    throw $ex;
                }
            }

        
        public function getByID($id)
        {
            $companyList = $this->getAll();
            $company_aux = new Company();

            foreach($companyList as $company)
            {
                if($company->getid() == $id)
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

                $query = " SELECT * FROM ".$this->tableName . " WHERE active = " .$status;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $company = new Company();
                    $company->setId($row["id"]);
                    $company->setName($row["name"]);
                    $company->setType($row["type"]);
                    $company->setActive($row["active"]);
                    $company->setEmail($row["email"]);
                    $company->setPassword($row["password"]);
                    array_push($companyList, $company);

                }
                return $companyList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
    
        public function getByName($name)
        {
            $companyList = $this->GetAll();
            $companyFounded = null;

            foreach($companyList as $company)
            {
                if($company->getName() == $name)
                {
                    $companyFounded = $company;
                }
            }

            return $companyFounded;
        }
        
        public function getByEmail($email)
        {
            $companyList = $this->GetAll();
            $companyFounded = null;

            foreach($companyList as $company)
            {
                if($company->getEmail() == $email)
                {
                    $companyFounded = $company;
                }
            }

            return $companyFounded;
        }

                   
    }
?>