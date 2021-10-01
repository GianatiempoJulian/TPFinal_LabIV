<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."company_list.php");
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
    }
?>