<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    //! Configuraciones:
    use Config\Autoload as Autoload;
    use Config\Config as Config;

    //! Modelos:
    use Models\Company as Company;
    use Models\JobOffer as JobOffer;
    use Models\JobPosition as JobPosition;
    use Models\Student as Student;

    //! DAO's:
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\StudentDAO as StudentDAO;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\IJobPositionDAO as IJobPositionDAO;

    Autoload::Start();

    class CompanyController
    {
        private $companyDAO;

        //! Constructor:
        //! =================================================================================================
        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }
        //! =================================================================================================

        //! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar empresa.

        public function ShowAddView()
        {
           
        require_once(VIEWS_PATH. "/company/add.php");
        }

        //? Vista dar de baja empresa.

        public function ShowRemoveView()
        {  
            if($_SESSION)
            {
                if($_SESSION['type'] == 1)
                {
                    $companyList = $this->companyDAO->getByStatus(1);
                    require_once(VIEWS_PATH. "/company/remove.php");
                }
                else
                {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
                }
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista dar de alta empresa.

        public function showAltaView()
        { 
            if($_SESSION)
            {
                if($_SESSION['type'] == 1)
                {
                    $companyList = $this->companyDAO->getByStatus(0);
                    require_once(VIEWS_PATH. "/company/alta.php");
                }
                else
                {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
                }
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista modificar empresa.

        public function showModifyView($comp_id)
        {
            if($_SESSION)
            {
                if($_SESSION['type'] == 1)
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
                    require_once(VIEWS_PATH."/company/modify.php");
                }
                else
                {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
                }
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista lista empresas.

        public function ShowListView()
        {
            if($_SESSION)
            {
                $companyList = $this->companyDAO->GetAll();
                require_once(VIEWS_PATH."/company/list.php");
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //! =================================================================================================

        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar empresa.

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

                    if(array_key_exists('type',$_SESSION)){
                        if($_SESSION['type'] == 1)
                        {
                            $this->ShowAddView();
                        }
                    }
                    else
                    {
                        require_once(VIEWS_PATH. "/auth/login.php");
                    } 
                }
                else
                {
                    echo "<script>alert('El nombre de esa empresa ya se encuentra en uso');</script>";
                    $this->ShowAddView();
                }
            }
         
        }

        //? Dar de baja empresa.
      
        public function Remove($comp_id)
        {
            $this->companyDAO->Remove($comp_id);
            echo "<script>alert('Empresa eliminada con exito');</script>";

            if($_SESSION['type'] == 2)
            {
                session_destroy();
                header("location:". FRONT_ROOT . "Login/Logout");
            }
            else
            {
                $this->ShowListView();
            }
        }

        //? Dar de alta empresa.

        public function Alta($comp_id)
        {
            $this->companyDAO->Alta($comp_id);
            echo "<script>alert('La empresa ha sido dada de alta');</script>";
            $this->ShowListView();
        }

        //? Modificar empresa.

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

        //! =================================================================================================

        //! Búsquedas especificas:
        //! =================================================================================================

        //? Mostrar ofertas de una empresa.

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
                 if ($stu->getEmail() == $_SESSION['email'])
                 {
                     $student_aux = $stu;
                 }
             }
 
            require_once(VIEWS_PATH. "/joboffer/list.php");
        }

        //? Buscar empresa por ID.

        public function ShowCompanyById($id)
        {
            $comp = $this->companyDAO->GetById($id);
            require_once(VIEWS_PATH. "/company/profile.php");
        }

        //? Buscar empresa por nombre.

        public function SearchCompany($comp_name){

            $comp = $this->companyDAO->SearchCompanyByName($comp_name);
           
            if($comp == null)
            {
                echo "<script>alert('Empresa inexistente');</script>";
                $this->ShowListView();
            }
            else
            {
                $this->ShowCompanyById($comp->GetComp_Id());
            }
        }

        //! =================================================================================================

    }
?>