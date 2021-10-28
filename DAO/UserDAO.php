<?php

namespace DAO;

require_once("Config/Autoload.php");

use Config\Autoload as Autoload;
use Models\User as User ;
use DAO\IUserDAO as IUserDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;

Autoload::Start();

Class UserDAO implements IUserDAO {

    private $userList = array();

    
    public function Add(User $user){
        $this->RetrieveData();
        array_push($this->userList,$user);
        $this->SaveData();
    }
    

    public function exist ($email,$pass){

       
       
        $users = $this->GetAll();

        $studentDAO = new StudentDAO();

        $student_list = $studentDAO->GetAll();
        $flag = -1;

        foreach ($users as $user)
    {
    
        //if(strcmp($mail,$student->getEmail) == 0 && $password == $student->getPassword)
        if(strcmp($email,$user->getEmail()) == 0)
        {
           // session_start();
           // $_SESSION["user_mail"] = $mail;
            //require("location: student_profile.php");
            $flag = 0;
        }

        if ($flag == -1)
        {
            foreach($student_list as $student)
            {
                if(strcmp($email,$student->getEmail()) == 0)
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
        
    }
        return $flag;
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->userList;
    }


    private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {


                $valuesArray["firstname"] = $user->getFirstName();
                $valuesArray["lastname"] = $user->getLastName();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["type"] = $user->getType_user();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Users.json', $jsonContent);
        }

    private function RetrieveData()
    {
        $this->userList = array();

       
            $jsonContent = file_get_contents('Data/Users.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
               $user  = new User();
                $user->setFirstName($valuesArray["firstname"]);
                $user->setLastName($valuesArray["lastname"]);
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["password"]);
                $user->setType_user($valuesArray["type"]);
                array_push($this->userList, $user);
            }
        
    }

    public function searchUser($email)
    {
        $this->RetrieveData();
        $user = null;

        foreach($this->userList as $us)
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
