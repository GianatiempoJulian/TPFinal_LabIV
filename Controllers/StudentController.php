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

        public function Add($firstName, $lastName, $recordId,$email,$careerId,$dni,$fileNumber,$gender,$birthDate,$phoneNumber,)
        {
            
            $student = new Student();
            $student->setStudentId($recordId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setType_user(1);
            $student->setEmail($email);

            $student->setCareerId($careerId);
            $student->setDni($dni);
            $student->setFileNumber($fileNumber);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive(true);

            $this->studentDAO->Add($student);
            $this->ShowAddView();
           
        }

       
    }
?>