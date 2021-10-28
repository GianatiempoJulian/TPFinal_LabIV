<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Config\Config as Config;

    Autoload::Start();

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
           require_once(VIEWS_PATH. "add-company.php");
          
        }

        public function ShowRemoveView()
        {
            require_once(VIEWS_PATH. "remove-company.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company_list.php");
        }

        public function ShowComp()
        {
            require_once(VIEWS_PATH . "company_profile.php");
        }

        public function ShowCompanyProfileView($id)
        {
            //require_once ($this->ShowComp(). "/?id=$id");
           // include(VIEWS_PATH. "company_profile.php?id=$id");
            
        }

        

        public function Add($comp_name, $comp_type)
        {

            if(isset($_POST))
            {
                if($this->companyDAO->SearchCompanyByName($comp_name) == NULL)
                {
                    $id = $this->companyDAO->CountCompanies() + 1;

                    $company = new Company();

                    $company->setComp_Id($id);
                    $company->setComp_name($comp_name);
                    $company->setComp_type($comp_type);

                    $this->companyDAO->Add($company);

                    $this->ShowAddView();
                }
                else
                {
                    $this->ShowAddView();
                }
            }
         
        }
      
        public function Remove($comp_id)
        {

            $this->companyDAO->Remove($comp_id);
            $this->ShowListView();
         
        }

        public function Modify()
        {

        }



        public function ShowCompanyById($id)
        {
            $comp = $this->companyDAO->GetById($id);
            require_once(VIEWS_PATH. "company_profile.php");

        }

        public function SearchCompany(){
            
        }

        /*public function RemoveForm()
        {
            require_once(VIEWS_PATH."remove-company.php");
        }

        public function Remove($id)
        {
            
            $this->companyDAO->Remove($id);
            require_once(VIEWS_PATH."remove-company.php");
        }*/

    }
?>