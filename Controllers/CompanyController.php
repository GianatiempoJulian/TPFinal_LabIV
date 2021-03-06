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
    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

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

        public function showModifyView($comp_id)
        {

            $companyList = $this->companyDAO->GetAll();

            $comp_aux = new Company();

            foreach ($companyList as $comp)
            {
                if ($comp->getComp_id() == $comp_id)
                {
                    $comp_aux = $comp;
                }
            }

            require_once(VIEWS_PATH."edit-company.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."company_list.php");
        }

        public function Add($comp_name, $comp_type, $comp_email, $comp_pass)
        {

            if(isset($_POST))
            {
                if($this->companyDAO->SearchCompanyByName($comp_name) == NULL && $this->companyDAO->SearchCompanyByEmail($comp_email) == NULL  )
                {

                    $comp_list = $this->companyDAO->GetAll();
                    $id = $this->companyDAO->CountCompanies()+1;
                    $company = new Company();
                    
                    $company->setComp_Id($id);
                    $company->setComp_name($comp_name);
                    $company->setComp_type($comp_type);
                    $company->setComp_active(true);
                    $company->setComp_email($comp_email);
                    $company->setComp_pass($comp_pass);
                    $company->setComp_type_int(2);


                    $this->companyDAO->Add($company);
                    echo "<script>alert('Empresa agregada con exito');</script>";

                    if($_SESSION['type'] == 1)
                    {
                        $this->ShowAddView();
                    }
                    else
                    {
                        require_once(VIEWS_PATH. "login.php");
                    } 
                    
                
                }
                
                else
                {
                    echo "<script>alert('El nombre de esa empresa ya se encuentra en uso');</script>";
                    $this->ShowAddView();
                }
            }
         
        }
      
        public function Remove($comp_id)
        {

            $this->companyDAO->Remove($comp_id);
            echo "<script>alert('Empresa eliminada con exito');</script>";
            $this->ShowListView();
         
        }

        public function Alta($comp_id)
        {

            $this->companyDAO->Alta($comp_id);
            echo "<script>alert('La empresa ha sido dada de alta');</script>";
            $this->ShowListView();
         
        }

        public function Modify($comp_id,$comp_name,$comp_type)
        {
            $comp_modify = new Company();

            $comp_modify->setComp_id($comp_id);
            $comp_modify->setComp_name($comp_name);
            $comp_modify->setComp_type($comp_type);
            $comp_modify->setComp_active(true);
            
             $this->companyDAO->Modify($comp_modify);

            $this->ShowCompanyById($comp_id);
            
        }

        public function ShowOffers($id)
        {
             $jobOffer_repository = new JobOfferDAO();
             $jo_list = $jobOffer_repository->GetAll();
 
             
             
             $jobPosition_repository = new JobPositionDAO();
             $jobPosition_list = $jobPosition_repository->GetAll();
             $jobPosition_aux = new JobPosition();
             
 
             $comp = $this->companyDAO->GetById($id);
 
          
             
             $company_list = $this->companyDAO->GetAll();
             $company_aux = new Company();
 
             $student_repository = new StudentDAO();
             $student_list = $student_repository->GetAll();
             $student_aux = new Student();
 
 
             foreach($student_list as $stu)
             {
                 if ($stu->getEmail() == $_SESSION['email']){
                     $student_aux = $stu;
                 }
             }
 
             if($_SESSION['type'] == 0)
             {
                 require_once(VIEWS_PATH. "offer-list.php");
             }  
             else if($_SESSION['type'] == 1)
             {
               
                 require_once(VIEWS_PATH. "offer-list-for-admin.php");
             }          
           
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

        /*
        public function ShowCompanyProfile()
        {
            $compList = $this->companyDAO->GetAll();
            $comp_mail = $_SESSION['email'];
            $comp_type = $_SESSION['type'];
            require_once(VIEWS_PATH. "company-profile-1.php");
        }
*/
      

    }
?>