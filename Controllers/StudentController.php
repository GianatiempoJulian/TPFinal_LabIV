<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    //! Configuraciones:
    use Config\Autoload as Autoload;
    use Config\Config as Config;

    //! Modelos:
    use Models\Student as Student;
    use Models\Career as Career;
    use Models\JobPosition as JobPosition;

    //! DAO's:
    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;

    Autoload::Start();

    class StudentController
    {
        private $studentDAO;

        //! Constructor:
        //! =================================================================================================
        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }
        //! =================================================================================================

        //! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar estudiante.

        public function ShowAddView()
        {
            require_once(VIEWS_PATH. "/student/add.php");
        }

        //? Vista perfil estudiante en sesión.

        public function ShowStudentProfile()
        {
            if($_SESSION)
            {

                $careerList =  new CareerDAO();
                $api_career = $careerList->GetAll();
                $career_from_student = new Career();
                $student = $this->studentDAO->searchStudentById($_SESSION['id_student']);
                foreach($api_career as $career)
                {
                    if($student->getCareerId() == $career->getCareerId())
                        {
                            $career_from_student = $career;
                        }
                }
                require_once(VIEWS_PATH. "/student/profile.php");
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Ver ofertas postuladas de un estudiante mediante su ID.

        public function ShowOfferStudent($id)
        {
           if($_SESSION)
            {
                //Job Offer
                $jobOffer_repository = new JobOfferDAO();
                $jo_list = $jobOffer_repository->GetAll();
                
                //Job Position para printear nombre posicion
                $jobPosition_repository = new JobPositionDAO();
                $jobPosition_list = $jobPosition_repository->GetAll();

                //SxJO para buscar ID estudiante vinculado a una oferta
                $student_x_offer = new StudentXJobOfferDAO();
                $student_x_offer_list = $student_x_offer->GetAll();

                //JobPosition para guardar el nombre
                $jobPosition_aux = new JobPosition();

                //Student para buscar estudiante con la ID que nos enviaron
                $student = $this->studentDAO->searchStudentById($id);

                require_once(VIEWS_PATH. "/student/joboffers-postulated.php");
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista de la lista de estudiantes.

        public function ShowListView()
        {
            if($_SESSION)
            {
                $studentList = $this->studentDAO->GetAll();
                require_once(VIEWS_PATH."/student/list.php");
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista modificar empresa.

        public function ShowModifyView($id)
        {
            if($_SESSION)
            {
                $student_aux = $this->studentDAO->searchStudentById($id);
                require_once(VIEWS_PATH."/student/modify.php");
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //! =================================================================================================


        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar estudiante.

        public function Add($email,$pass)
        {
            $flag = 0;
            $student_api = $this->studentDAO->GetAllFromApi();

            foreach ($student_api as $student_from_api)
            {
                if ($student_from_api->getEmail() == $email && $student_from_api->getActive() == true)
                {
                    $student = new Student();
                    $student->setStudentId($student_from_api->getStudentId());
                    $student->setFirstName($student_from_api->getFirstName());
                    $student->setLastName($student_from_api->getLastName());
                    $student->setType_user(0);
                    $student->setEmail($student_from_api->getEmail());
        
                    $student->setCareerId($student_from_api->getCareerId());
                    $student->setDni($student_from_api->getDni());
                    $student->setFileNumber($student_from_api->getFileNumber());
                    $student->setGender($student_from_api->getGender());
                    $student->setBirthDate($student_from_api->getBirthDate());
                    $student->setPhoneNumber($student_from_api->getPhoneNumber());
                    $student->setActive(true);
                    $student->setPassword($pass);
                    $this->studentDAO->Add($student);

                    echo "<script>alert('Registro exitoso');</script>";
                    require_once(VIEWS_PATH. "login.php");
                    $flag = 1;
                }  
            }
            if ($flag == 0)
            {
                 echo "<script>alert('El mail ingresado no perenece a un alumno activo');</script>";
                $this->ShowAddView();
                
            }
        }

        //! =================================================================================================
    }
?>