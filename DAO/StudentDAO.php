<?php


    namespace DAO;

    require_once("Config/Autoload.php");
  
    use Config\Autoload as Autoload;
    use \Exception as Exception;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use DAO\Connection as Connection;
    use DAO\APIDAO as APIDAO;
  
   
    
    
    class StudentDAO implements IStudentDAO{

        private $connection;
        private $tableName = "students";
        private $studentList = array();
      

        public function Add(Student $student)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (recordId, firstName, lastName,email,type_us,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES (:recordId, :firstName, :lastName, :email, :type_us, :careerId, :dni, :fileNumber, :gender, :birthDate, :phoneNumber, :active,:s_password);";

                $parameters["recordId"] = $student->getStudentId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["email"] = $student->getEmail();
                $parameters["type_us"] = $student->getType_user();
                $parameters["s_password"] = $student->getPassword();

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

        public function GetAll()
        {
            try {
                $studentList = array();
                $query = " SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $student = new Student();
                    $student->setStudentId($row["recordId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setEmail($row["email"]);
                    $student->setType_user($row["type_us"]);
                    $student->setPassword($row["s_password"]);

                    $student->setCareerId($row["careerId"]);
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


        public function searchStudent($email)
        {
            $studentList = $this->GetAll();
            $student = null;
    
            foreach($studentList as $std)
            {
                if($std->getEmail() == $email)
                {
                    $student = $std;
                }
            }
            return $student;
        }

        public function searchStudentById($id)
        {
            $studentList = $this->GetAll();
            $student = null;
    
            foreach($studentList as $std)
            {
                if($std->getStudentId() == $id)
                {
                    $student = $std;
                }
            }
            return $student;
        }


        public function GetAllFromApi()
        {
            $this->RetrieveDataFromAPI();
            return $this->studentList;
        }

        private function RetrieveDataFromAPI()
        {
            $student_list = APIDAO::RetrieveStudents();

            foreach($student_list as $student)
            {
                $new_student = new Student();
                $new_student->setStudentId($student["studentId"]);
                $new_student->setFirstName($student["firstName"]);
                $new_student->setLastName($student["lastName"]);
                $new_student->setCareerId($student["careerId"]);
                $new_student->setDni($student["dni"]);
                $new_student->setFileNumber($student["fileNumber"]);
                $new_student->setGender($student["gender"]);
                $new_student->setBirthDate($student["birthDate"]);
                $new_student->setEmail($student["email"]);
                $new_student->setPhoneNumber($student["phoneNumber"]);
                $new_student->setActive($student["active"]);
                
                array_push($this->studentList, $new_student);
            }
        }

    }
?>