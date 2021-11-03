<?php
    namespace Controllers;

    require_once("Config/Autoload.php");

    use Config\Autoload as Autoload;
    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\Student as Student;
    use Models\Career as Career;
    use Config\Config as Config;

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


            require_once(VIEWS_PATH. "student_profile.php");
        }

        public function ShowListView()
        {
  
            $studentList = $this->studentDAO->GetAll();
  
            require_once(VIEWS_PATH."student-list.php");
        }

        public function Add($email)
        {
            
            $flag = 0;
            $student_api = $this->studentDAO->GetAllFromApi();


            foreach ($student_api as $student_from_api)
            {
                if ($student_from_api->getEmail() == $email)
                {
                    $student = new Student();
                    $student->setStudentId($student_from_api->getStudentId());
                    $student->setFirstName($student_from_api->getFirstName());
                    $student->setLastName($student_from_api->getLastName());
                    $student->setType_user(1);
                    $student->setEmail($student_from_api->getEmail());
        
                    $student->setCareerId($student_from_api->getCareerId());
                    $student->setDni($student_from_api->getDni());
                    $student->setFileNumber($student_from_api->getFileNumber());
                    $student->setGender($student_from_api->getGender());
                    $student->setBirthDate($student_from_api->getBirthDate());
                    $student->setPhoneNumber($student_from_api->getPhoneNumber());
                    $student->setActive(true);

                    $this->studentDAO->Add($student);
                    header("location:". FRONT_ROOT . "Login/showLoginView");
                    $flag = 1;
                   
                    
        
                }
                
                
            }
            if ($flag == 0)
            {
                
                $this->ShowAddView();
                
            }
          

           
           
           
        }

       
    }
?>