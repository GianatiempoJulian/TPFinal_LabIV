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
      

        public function add(Student $student)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (recordId, firstName, lastName,email,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,password) VALUES (:recordId, :firstName, :lastName, :email, :careerId, :dni, :fileNumber, :gender, :birthDate, :phoneNumber, :active,:password);";

                $parameters["recordId"] = $student->getRecordId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["email"] = $student->getEmail();
                $parameters["password"] = $student->getPassword();
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

        public function getAll()
        {
            try {
                $studentList = array();
                $query = " SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row){

                    $student = new Student();
                    $student->setRecordId($row["recordId"]);
                    $student->setFirstname($row["firstname"]);
                    $student->setLastname($row["lastname"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
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


        public function getByEmail($email)
        {
            $studentList = $this->getAll();
            $studentFounded = null;
    
            foreach($studentList as $student)
            {
                if($student->getEmail() == $email)
                {
                    $studentFounded = $student;
                }
            }
            return $studentFounded;
        }

        public function getByID($id)
        {
            $studentList = $this->getAll();
            $studentFounded = null;
    
            foreach($studentList as $student)
            {
                if($student->getRecordId() == $id)
                {
                    $studentFounded = $student;
                }
            }
            return $studentFounded;
        }


        public function getAllFromApi()
        {
            $this->retrieveDataFromAPI();
            return $this->studentList;
        }

        private function retrieveDataFromAPI()
        {
            $studentsFromApi = APIDAO::retrieveStudents();

            foreach($studentsFromApi as $students)
            {
                foreach($students as $student)
                {
                    $newStudent = new Student();
                    $newStudent->setRecordId($student["recordId"]);
                    $newStudent->setFirstName($student["firstName"]);
                    $newStudent->setLastName($student["lastName"]);
                    $newStudent->setCareerId($student["careerId"]);
                    $newStudent->setDni($student["dni"]);
                    $newStudent->setFileNumber($student["fileNumber"]);
                    $newStudent->setGender($student["gender"]);
                    $newStudent->setBirthDate($student["birthDate"]);
                    $newStudent->setEmail($student["email"]);
                    $newStudent->setPhoneNumber($student["phoneNumber"]);
                    $newStudent->setActive($student["active"]);
                    array_push($this->studentList, $newStudent);
                }
            }
        }

    }
?>