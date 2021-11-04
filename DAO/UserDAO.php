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

    
    /*
    public function Add(User $user){
        $this->RetrieveData();
        array_push($this->userList,$user);
        $this->SaveData();
    }
    */

    public function Add(User $user){
        try {
            $query = "INSERT INTO ".$this->tableName." ( u_firstName,  u_lastName,  u_email,  u_password,  u_type) VALUES (: u_firstName, : u_lastName, : u_email, : u_password, : u_type);";

            $parameters["u_firstName"] = $user->getFirstName();
            $parameters["u_lastName"] = $user->getLastName();
            $parameters["u_email"] = $user->getEmail();
            $parameters["u_password"] = $user->getPassword();
            $parameters["u_type"] = $user->getType_user();

            echo "n".$parameters["u_firstName"];
            echo "a".$parameters["u_lastName"];
            echo "e".$parameters["u_email"];
            echo  "p".$parameters["u_password"];
            echo  "t".$parameters["u_type"];

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

        }
        catch(Exception $ex){
            throw $ex;
        }
    }
   
    
    public function exist ($email,$pass){

       
       
        $users = $this->GetAll();

        $studentDAO = new StudentDAO();

        $student_list = $studentDAO->GetAll();
        
        $flag = -1;


        foreach ($users as $user)
         {
    
     
        //if(strcmp($mail,$user->getEmail) == 0 && $password == $user->getPassword)
        if(strcmp($email,$user->getEmail()) == 0)
        {
           
           // session_start();
           // $_SESSION["user_mail"] = $mail;
            //require("location: student_profile.php");
            $flag = 1;
        }

    }
        if ($flag == -1)
        {
            
            foreach($student_list as $user)
            {
               
                if(strcmp($email,$user->getEmail()) == 0)
                {
                   // session_start();
                   // $_SESSION["user_mail"] = $mail;
                    //require("location: student_profile.php");
                    $flag = 0;
                }
            }
        }
    /*
        else{
           
           // header("location: login.php?msg=incorrect");
        }
        */
        
    
        return $flag;
    }
    

   
    public function GetAll(){
        try {
            $userList = array();

            $query = " SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row){

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
        catch (Exception $ex){
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
