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
    private $tableName = "users";

    
    /*
    public function Add(User $user){
        $this->RetrieveData();
        array_push($this->userList,$user);
        $this->SaveData();
    }
    */

    public function Add(User $user){
        try {
            $query = "INSERT INTO ".$this->tableName." (firstName, lastName, email, password, type_user) VALUES (:firstName, :lastName, :email, :password, :type_user);";

            $parameters["firstName"] = $user->getFirstName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["type_user"] = $user->getType_user();

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
            $flag = 0;
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
                    $flag = 1;
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
                $user->setFirstName($row["firstName"]);
                $user->setLastName($row["lastName"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setType_user($row["type_user"]);

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
