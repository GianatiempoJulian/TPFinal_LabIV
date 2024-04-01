<?php

namespace DAO;

require_once("Config/Autoload.php");

use Config\Autoload as Autoload;
use Models\Administrator as Administrator ;
use DAO\IAdministratorDAO as IAdministratorDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use \Exception as Exception;
use DAO\Connection as Connection;

Autoload::Start();

Class AdministratorDAO implements IAdministratorDAO {

    private $admnistratorList = array();
    private $connection;
    private $tableName = "Administrators";


    public function add(Administrator $administrator)
    {
        try {
            $query = "INSERT INTO ".$this->tableName." ( firstname,  lastname,  email,  password) VALUES (:firstname, :lastname, :email, :password);";
            $parameters["firstname"] = $administrator->getfirstname();
            $parameters["lastname"] = $administrator->getlastname();
            $parameters["email"] = $administrator->getEmail();
            $parameters["password"] = password_hash($administrator->getPassword(),PASSWORD_DEFAULT);

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $flag){
            $flag = 1;
            return $flag;
        }
    }
   
    
    public function exist ($email,$pass)
    {
        $Administrators = $this->GetAll();

        $studentDAO = new StudentDAO();
        $student_list = $studentDAO->GetAll();

        $companyDAO = new CompanyDAO();
        $company_list = $companyDAO->GetAll();
        
        $flag = -1;

        foreach ($Administrators as $Administrator)
        {
            if(strcmp($email,$Administrator->getEmail()) == 0 && password_verify($pass,$Administrator->getPassword()))
            {
                $flag = 1;
            }
        }
        if ($flag == -1)
        {
            foreach($student_list as $stu)
            {
                if(strcmp($email,$stu->getEmail()) == 0 && $pass == $stu->getPassword())
                {
                    $flag = 0;
                }
            }
            foreach($company_list as $comp)
            {
                if(strcmp($email,$comp->getEmail()) == 0 && password_verify($pass, $comp->getPassword()))
                {
                    $flag = 2;
                }
            }
        }
        return $flag;
    }
    
    public function getAll()
    {
        try {
            $admnistratorList = array();
            $query = " SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $administrator = new Administrator();
                $administrator->setfirstname($row["firstname"]);
                $administrator->setlastname($row["lastname"]);
                $administrator->setEmail($row["email"]);
                $administrator->setPassword($row["password"]);
            
                array_push($admnistratorList, $administrator);
            }
            return $admnistratorList;
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

    public function searchByEmail($email)
    {
        $admnistratorList = $this->GetAll();
        $administratorFounded = null;

        foreach($admnistratorList as $administrator)
        {
            if($administrator->getEmail() == $email)
            {
                $administratorFounded = $administrator;
            }
        }
        return $administratorFounded;
    } 
}
?>
