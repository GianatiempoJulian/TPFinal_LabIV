<?php

    namespace DAO;

    
    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
  
   
    Autoload::Start();

    Class CompanyDAO implements ICompanyDAO{
        private $companyList = array();
        private $fileName;
      
        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/Companies.json";
        }

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
        }
    }
?>