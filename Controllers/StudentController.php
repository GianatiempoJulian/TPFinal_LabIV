<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\Student as Student;
    use Models\Career as Career;
    use Config\Config as Config;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;
    use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;

    Autoload::Start();

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView()
        {
           require_once(VIEWS_PATH. "add-student.php");
        }

        public function ShowStudentProfile()
        {
            $studentList = $this->studentDAO->GetAll();
            $careerList =  new CareerDAO();
            $api_career = $careerList->GetAll();
            $career_from_student = new Career();

            $id = $_SESSION['id_student'];
            require_once(VIEWS_PATH. "student_profile.php");
        }

        public function ShowOfferStudent($id)
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

            
           require_once(VIEWS_PATH. "student-postulations.php");
        }

        public function ShowListView()
        {
  
            $studentList = $this->studentDAO->GetAll();
  
            require_once(VIEWS_PATH."student-list.php");
        }

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

       
    }
?>