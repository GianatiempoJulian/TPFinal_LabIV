<?php
    namespace Controllers;

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");
//require_once("../Config/Config.php");

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
  //  use Config\Config as Config;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            echo "4";
           // require_once("Views/add-company.php");
           header ("location: add-company.php?msg=ingreso");
            echo "5";
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company_list.php");
        }

        public function Add($id, $name, $type)
        {
            
            $company = new Company();
            $company->setComp_Id($id);
            $company->setComp_name($name);
            $company->setComp_type($type);
            $this->companyDAO->Add($company);
           $this->ShowAddView();
           
        }

        

        ///hacer remove

        ///hacer edit

        
        public function X ($company){
            $string_saved = "company_profile.php?comp_id=";
            $string_id =  strval($company->getComp_id());
            $x = $string_saved.$string_id . ".php";

            return $x;
            
       }
    }
?>