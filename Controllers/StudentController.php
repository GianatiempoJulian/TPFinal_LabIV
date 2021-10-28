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
           
           require_once(VIEWS_PATH. ".php");
          //header ("location: add-company.php?msg=ingreso");  
        }

        public function ShowStudentProfile()
        {
            $studentList = $this->studentDAO->GetAll();
            
            $careerList =  new CareerDAO();
            $api_career = $careerList->GetAll();
            $career_from_student = new Career();


            require_once(VIEWS_PATH. "student_profile.php");
        }

       /* public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company_list.php");
        }*/

        /*public function Add($id, $name, $type)
        {
            
            $student = new Company();
            $company->setComp_Id($id);
            $company->setComp_name($name);
            $company->setComp_type($type);
            $this->companyDAO->Add($company);
            $this->ShowAddView();
           
        }*/

       
    }
?>