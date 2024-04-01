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
                if($_SESSION['type'] != 0) {
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

        public function add($name, $type, $email, $password)
        {
            if(isset($_POST)) {
                if($this->companyDAO->getByName($name) == NULL && $this->companyDAO->getByEmail($email) == NULL) {
                    $list = $this->companyDAO->getAll();
                    $company = new Company();
                    $company->setName($name);
                    $company->setType($type);
                    $company->setActive(true);
                    $company->setEmail($email);
                    $company->setPassword($password);
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
                    echo "<script>alert('El nombre o correo de esa empresa ya se encuentra en uso');</script>";
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


        //? Modificar empresa.

        public function modify($id,$name,$type)
        {
            $companyModify = new Company();
            $companyModify->setid($id);
            $companyModify->setName($name);
            $companyModify->setType($type);
            $companyModify->setActive(true);
            
            $this->companyDAO->modify($companyModify);
            $this->showCompanyById($id);
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

        public function ShowCompanyById($companyId)
        {
            $company = $this->companyDAO->getById($companyId);
            require_once(VIEWS_PATH. "/company/profile.php");
        }

        //? Buscar empresa por nombre.

        public function getByName($name){

            $comp = $this->companyDAO->getByName($name);
           
            if($comp == null){
                echo "<script>alert('Empresa inexistente');</script>";
                $this->showListView();
            } else {
                $this->showCompanyById($comp->getId());
            }
        }

        //! =================================================================================================

    }
?>