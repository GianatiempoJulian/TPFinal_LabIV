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
    use DAO\MessageDAO as MessageDAO;

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
                $apiCareer = $careerList->GetAll();
                $careerFromStudent = new Career();
                $student = $this->studentDAO->searchStudentById($_SESSION['id_student']);
                foreach($apiCareer as $career)
                {
                    if($student->getCareerId() == $career->getCareerId())
                        {
                            $careerFromStudent = $career;
                        }
                }
                require_once(VIEWS_PATH. "/student/profile.php");
            }
            else
            {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Ver ofertas postuladas de un estudiante mediante su ID.

        public function ShowOfferStudent($studentId)
        {
           if($_SESSION) {
                //Job Offers:
                $jobOfferList = (new JobOfferDAO())->GetAll();
                
                //Job Position para printear nombre posicion
                $jobPositionList = (new JobPositionDAO())->GetAll();

                //SxJO para buscar ID estudiante vinculado a una oferta
                $studentXJobOfferList = (new StudentXJobOfferDAO())->GetAll();

                //JobPosition para guardar el nombre
                $jobPositionAux = new JobPosition();

                //Student para buscar estudiante con la ID que nos enviaron
                $student = $this->studentDAO->searchStudentById($studentId);

                require_once(VIEWS_PATH. "/student/joboffers-postulated.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista de la lista de estudiantes.

        public function ShowListView()
        {
            if($_SESSION) {
                $studentList = $this->studentDAO->GetAll();
                require_once(VIEWS_PATH."/student/list.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista modificar empresa.

        public function ShowModifyView($studentId)
        {
            if($_SESSION) {
                $studentAux = $this->studentDAO->searchStudentById($studentId);
                require_once(VIEWS_PATH."/student/modify.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //! =================================================================================================


        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar estudiante.

        public function Add($email,$pass)
        {
            $flag = 0;
            $studentsApi = $this->studentDAO->GetAllFromApi();

            foreach ($studentsApi as $studentFromApi) {
                if ($studentFromApi->getEmail() == $email && $studentFromApi->getActive() == true) {
                    $student = new Student();
                    $student->setStudentId($studentFromApi->getStudentId());
                    $student->setFirstName($studentFromApi->getFirstName());
                    $student->setLastName($studentFromApi->getLastName());
                    $student->setType_user(0);
                    $student->setEmail($studentFromApi->getEmail());
        
                    $student->setCareerId($studentFromApi->getCareerId());
                    $student->setDni($studentFromApi->getDni());
                    $student->setFileNumber($studentFromApi->getFileNumber());
                    $student->setGender($studentFromApi->getGender());
                    $student->setBirthDate($studentFromApi->getBirthDate());
                    $student->setPhoneNumber($studentFromApi->getPhoneNumber());
                    $student->setActive(true);
                    $student->setPassword($pass);
                    $this->studentDAO->Add($student);

                    echo "<script>alert('Registro exitoso');</script>";
                    require_once(VIEWS_PATH. "login.php");
                    $flag = 1;
                }  
            } if ($flag == 0) {
                 echo "<script>alert('El mail ingresado no perenece a un alumno activo');</script>";
                $this->ShowAddView();
            }
        }

        //! =================================================================================================
    }
?>