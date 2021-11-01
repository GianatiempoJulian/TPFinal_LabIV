<?php


    namespace DAO;

    require_once("Config/Autoload.php");
  
    use Config\Autoload as Autoload;
    use \Exception as Exception;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use DAO\Connection as Connection;
  
   
    
    
    class StudentDAO implements IStudentDAO{

        private $connection;
        private $tableName = "students";
      

        public function Add(Student $student){
            try {
                $query = "INSERT INTO ".$this->tableName." (recordId, firstName, lastName,email,type_us,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active) VALUES (:recordId, :firstName, :lastName, :email, :type_us, :careerId, :dni, :fileNumber, :gender, :birthDate, :phoneNumber, :active);";

                $parameters["recordId"] = $student->getStudentId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["email"] = $student->getEmail();
                $parameters["type_us"] = $student->getType_user();

                $parameters["careerId"] = $student->getCareerId();
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFileNumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthDate"] = $student->getBirthDate();
                $parameters["phoneNumber"] = $student->getPhoneNumber();
                $parameters["active"] = $student->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $studentList = array();

                $query = " SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $student = new Student();
                    $student->setStudentId($row["recordId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastname"]);
                    $student->setEmail($row["email"]);
                    $student->setType_user($row["type_us"]);
                    $student->getCareerId($row["careerId"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);


                    array_push($studentList, $student);

                }
                return $studentList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }




        /*
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

    

       
        private function SaveData(){
            $arrayToEncode = array();

            foreach($this->studentList as $student){
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
                $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                $valuesArray["gender"] = $student->getGender();
                $valuesArray["birthDate"] = $student->getBirthDate();
                $valuesArray["email"] = $student->getEmail();
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["careerId"] = $student->getCareerId();
                $valuesArray["fileNumber"] = $student->getFileNumber();
                $valuesArray["active"] = $student->getActive();
                $valuesArray["type"] = 0;
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function RetrieveData(){

            $this->studentList = array();
      

                $opt = array(
                    "http" => array(
                    "method" => "GET",
                    "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
                    )
                );
            
                $ctx = stream_context_create($opt);
            
                $jsonContent = file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
            
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
    
                foreach($arrayToDecode as $valuesArray){

                   
                    $student = new Student();
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]) ;
                    $student->setDni($valuesArray["dni"]);
                    $student-> setPhoneNumber($valuesArray["phoneNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student-> setStudentId($valuesArray["studentId"]);
                    $student-> setCareerId($valuesArray["careerId"]);
                    $student->setFileNumber($valuesArray["fileNumber"]);
                    $student-> setActive($valuesArray["active"]);
                    $student->setType_user(0);

                   
                    array_push($this->studentList,$student);
               // }
            }
        }

        public function searchStudent($email)
        {
            $this->RetrieveData();
            $student = null;
    
            foreach($this->studentList as $std)
            {
                
                if($std->getEmail() == $email)
                {
                    $student = $std;
                }
            }
    
            return $student;
        }*/
    }
?>