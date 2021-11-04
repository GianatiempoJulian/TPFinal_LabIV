<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Config\Config as Config;
    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;
    use DAO\IJobPositionDAO as IJobPositionDAO;

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

        public function showAltaView()
        {
            require_once(VIEWS_PATH. "alta-company.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."company_list.php");
        }

        public function Add($comp_name, $comp_type)
        {

            if(isset($_POST))
            {
                if($this->companyDAO->SearchCompanyByName($comp_name) == NULL)
                {

                    $comp_list = $this->companyDAO->GetAll();
                    $id = $this->companyDAO->CountCompanies()+1;
                    $company = new Company();
                    
                    $company->setComp_Id($id);
                    $company->setComp_name($comp_name);
                    $company->setComp_type($comp_type);
                    $company->setComp_active(true);

                    $this->companyDAO->Add($company);

                    $this->ShowAddView();
                }
                
                else
                {
                    echo "Nombre en uso, intente con otro";
                    $this->ShowAddView();
                }
            }
         
        }
      
        public function Remove($comp_id)
        {

            $this->companyDAO->Remove($comp_id);
            $this->ShowListView();
         
        }

        public function Alta($comp_id)
        {

            $this->companyDAO->Alta($comp_id);
            $this->ShowListView();
         
        }

       public function ShowOffers($id)
       {
            $jobOffer_repository = new JobOfferDAO();
            $jo_list = $jobOffer_repository->GetAll();
            
            $jobPosition_repository = new JobPositionDAO();
            $jobPosition_list = $jobPosition_repository->GetAll();
            $jobPosition_aux = new JobPosition();
            

            $comp = $this->companyDAO->GetById($id);

           
            
           require_once(VIEWS_PATH. "offer-list.php");
       }


        public function ShowModifyView()
        {
            require_once(VIEWS_PATH. "add-student.php");
        }

        public function ShowCompanyById($id)
        {
            $comp = $this->companyDAO->GetById($id);
            require_once(VIEWS_PATH. "company_profile.php");

        }

        public function SearchCompany($comp_name){

           $comp = $this->companyDAO->SearchCompanyByName($comp_name);
           $this->ShowCompanyById($comp->GetComp_Id());

            
        }

      

    }
?>