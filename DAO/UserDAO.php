<?php

namespace DAO;

require_once("Config/Autoload.php");

use Config\Autoload as Autoload;
use Models\User as User ;
use DAO\IUserDAO as IUserDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use \Exception as Exception;
use DAO\Connection as Connection;

Autoload::Start();

Class UserDAO implements IUserDAO {

    private $userList = array();
    private $connection;
    private $tableName = "USERS";


    public function Add(User $user)
    {
        try {

            $query = "INSERT INTO ".$this->tableName." ( u_firstName,  u_lastName,  u_email,  u_password,  u_type) VALUES (:u_firstName, :u_lastName, :u_email, :u_password, :u_type);";
            $parameters["u_firstName"] = $user->getFirstName();
            $parameters["u_lastName"] = $user->getLastName();
            $parameters["u_email"] = $user->getEmail();
            $parameters["u_password"] = password_hash($user->getPassword(),PASSWORD_DEFAULT);
            $parameters["u_type"] = $user->getType_user();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex){
            throw $ex;
        }
    }
   
    
    public function exist ($email,$pass)
    {
        $users = $this->GetAll();

        $studentDAO = new StudentDAO();
        $student_list = $studentDAO->GetAll();

        $companyDAO = new CompanyDAO();
        $company_list = $companyDAO->GetAll();
        
        $flag = -1;

        foreach ($users as $user)
        {
            if(strcmp($email,$user->getEmail()) == 0 && password_verify($pass,$user->getPassword()))
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
                if(strcmp($email,$comp->getComp_email()) == 0 && password_verify($pass, $comp->getComp_pass()))
                {
                    $flag = 2;
                }
            }
        }
        return $flag;
    }
    
    public function GetAll(){
        try {
            $userList = array();
            $query = " SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $user = new User();
                $user->setFirstName($row["u_firstName"]);
                $user->setLastName($row["u_lastName"]);
                $user->setEmail($row["u_email"]);
                $user->setPassword($row["u_password"]);
                $user->setType_user($row["u_type"]);

                array_push($userList, $user);
            }
            return $userList;
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

    public function searchUser($email)
    {
        $userList = $this->GetAll();
        $user = null;

        foreach($userList as $us)
        {
            if($us->getEmail() == $email)
            {
                $user = $us;
            }
        }
        return $user;
    } 
}
?>
