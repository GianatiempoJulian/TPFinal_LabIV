<?php



    namespace DAO;

    
  

       
    
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
  
    require_once("IStudentDAO.php");
    

   


    Class StudentDAO implements IStudentDAO{
        private $studentList = array();
        private $fileName;
      
        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/Students.json";
        }

        public function callAPI(){

            $opt = array(
                "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
                )
            );
        
            $ctx = stream_context_create($opt);
        
            return file_get_contents("https://utn-students-api.herokuapp.com/api/Career", false, $ctx);
        }

        public function Add(Student $student){
            $this->RetrieveData();
            array_push($this->studentList,$student);
            $this->SaveData();
        }

        public function Remove($student_id){

            $this->retrieveData();
		    $newList = array();

		    foreach ($this->studentList as $student) {
			    if($student->getStudentId()!= $student_id){
				    array_push($newList, $student);
			    }
		}

		$this->researchList = $newList;
		$this->saveData();
        }

    

        public function GetAll(){
            $this->RetrieveData();
            return $this->studentList;
        }

        private function SaveData(){
            $arrayToEncode = array();

            foreach($this->studentList as $student){
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["careerId"] = $student->getCareerId();
                $valuesArray["firstName"] = $student->getFirtsName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
                $valuesArray["fileNumber"] = $student->getFileNumbrer();
                $valuesArray["gender"] = $student->getGender();
                $valuesArray["birthDate"] = $student->getBirthDate();
                $valuesArray["email"] = $student->getEmail();
                $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                $valuesArray["active"] = $student->getActive();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function RetrieveData(){
            $this->studentList = array();

            if(file_exists($this->fileName)){
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $student = new Student();

                    $student-> setStudentId($valuesArray["studentId"]);
                    $student-> setCareerId($valuesArray["careerId"]);
                    $student->setFirtsName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]) ;
                    $student->setDni($valuesArray["dni"]);
                    $student->setFileNumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setEmail(valuesArray["email"]);
                    $student-> setPhoneNumber($valuesArray["phoneNumber"]);
                    $student-> setActive($valuesArray["active"]);

                   
                    array_push($this->studentList,$student);
                }
            }
        }
    }
?>