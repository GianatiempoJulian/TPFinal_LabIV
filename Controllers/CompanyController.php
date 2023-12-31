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
    use DAO\MessageDAO as MessageDAO;

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

        public function showAddView()
        {
            require_once(VIEWS_PATH. "/company/add.php");
        }

        //? Vista dar de baja empresa.

        public function showRemoveView()
        {
            if ($_SESSION) {
                if ($_SESSION['type'] == 1) {
                    $companyList = $this->companyDAO->getByStatus(1);
                    require_once(VIEWS_PATH . "/company/remove.php");
                } else {
                    $messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
                }
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista dar de alta empresa.

        public function showAltaView()
        { 
            if($_SESSION) {
                if($_SESSION['type'] == 1) {
                    $companyList = $this->companyDAO->getByStatus(0);
                    require_once(VIEWS_PATH. "/company/alta.php");
                } else {
                    $messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
                }
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista modificar empresa.

        public function showModifyView($companyId)
        {
            if($_SESSION) {
                if($_SESSION['type'] == 1) {
                    $companyAux = new Company();
                    $companyAux = $this->companyDAO->getById($companyId);
                    require_once(VIEWS_PATH."/company/modify.php");
                } else {
                    $messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
                }
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista lista empresas.

        public function showListView()
        {
            if($_SESSION) {
                $companyList = $this->companyDAO->getAll();
                require_once(VIEWS_PATH."/company/list.php");
            }
            else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //! =================================================================================================

        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar empresa.

        public function add($comp_name, $comp_type, $comp_email, $comp_pass)
        {
            if(isset($_POST)) {
                if($this->companyDAO->searchCompanyByName($comp_name) == NULL && $this->companyDAO->searchCompanyByEmail($comp_email) == NULL) {

                    $comp_list = $this->companyDAO->getAll();
                    $id = $this->companyDAO->countCompanies()+1;

                    $company = new Company();
                    $company->setComp_Id($id);
                    $company->setComp_name($comp_name);
                    $company->setComp_type($comp_type);
                    $company->setComp_active(true);
                    $company->setComp_email($comp_email);
                    $company->setComp_pass($comp_pass);
                    $company->setComp_type_int(2);
                    $this->companyDAO->add($company);
                    echo "<script>alert('Empresa agregada con exito');</script>";

                    if(array_key_exists('type',$_SESSION)){
                        if($_SESSION['type'] == 1) {
                            $this->showAddView();
                        }
                    } else {
                        require_once(VIEWS_PATH. "/auth/login.php");
                    } 
                }
                else {
                    echo "<script>alert('El nombre de esa empresa ya se encuentra en uso');</script>";
                    $this->showAddView();
                }
            }
        }

        //? Dar de baja empresa.
      
        public function remove($companyId)
        {
            $this->companyDAO->remove($companyId);
            echo "<script>alert('Empresa eliminada con exito');</script>";

            if($_SESSION['type'] == 2) {
                session_destroy();
                header("location:". FRONT_ROOT . "Login/Logout");
            } else {
                $this->showListView();
            }
        }

        //? Dar de alta empresa.

        public function alta($companyId)
        {
            $this->companyDAO->alta($companyId);
            echo "<script>alert('La empresa ha sido dada de alta');</script>";
            $this->showListView();
        }

        //? Modificar empresa.

        public function modify($companyId,$companyName,$companyType)
        {
            $companyModify = new Company();
            $companyModify->setComp_id($companyId);
            $companyModify->setComp_name($companyName);
            $companyModify->setComp_type($companyType);
            $companyModify->setComp_active(true);
            
            $this->companyDAO->modify($companyModify);
            $this->showCompanyById($companyId);
        }

        //! =================================================================================================

        //! Búsquedas especificas:
        //! =================================================================================================

        //? Mostrar ofertas de una empresa.

        public function showOffers($companyId)
        {
            $jobOfferRepository = new JobOfferDAO();
            $jobOfferList = $jobOfferRepository->getAll();

            $jobPositionRepository = new JobPositionDAO();
            $jobPositionList = $jobPositionRepository->getAll();
            $jobPositionAux = new JobPosition();

            $company = $this->companyDAO->getById($companyId);

            $companyList = $this->companyDAO->getAll();
            $companyAux = new Company();

            $studentRepository = new StudentDAO();
            $studentList = $studentRepository->getAll();
            $studentAux = new Student();

            foreach ($studentList as $student) {
                if ($student->getEmail() == $_SESSION['email']) {
                    $studentAux = $student;
                }
            }

            require_once(VIEWS_PATH . "/joboffer/list.php");
        }


        //? Buscar empresa por ID.

        public function showCompanyById($companyId)
        {
            $comp = $this->companyDAO->getById($companyId);
            require_once(VIEWS_PATH. "/company/profile.php");
        }

        //? Buscar empresa por nombre.

        public function searchCompany($companyName){

            $comp = $this->companyDAO->searchCompanyByName($companyName);
           
            if($comp == null){
                echo "<script>alert('Empresa inexistente');</script>";
                $this->showListView();
            } else {
                $this->showCompanyById($comp->getComp_Id());
            }
        }

        //! =================================================================================================

    }
?>