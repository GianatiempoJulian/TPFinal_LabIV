<?php

namespace Controllers;

use DAO\UserDao as UserDAO;
use DAO\StudentDAO as StudentDAO;


class LoginController
{
    public function showRegisterView (){
        require_once(VIEWS_PATH . "register.php");
    }

    public function showLoginView (){
        require_once(VIEWS_PATH . "login.php");
    }


public function toType($type){

    if ($type == 0)
    {
        header("location:". FRONT_ROOT . "Student/ShowAddView");
    }
    else if($type == 1)
    {
        header("location:". FRONT_ROOT . "User/ShowAddView");
       
    }
}

public function Verify($user_mail,$password)
{
    
   
        $users = new UserDAO();
        $students = new StudentDAO();

        $flag = $users->exist($user_mail,$password);
        $user_in_session = null;

    

        
        if($flag == 0)
        {
            
            $student_in_session = $students->searchStudent($user_mail);
            $_SESSION['id_student'] = $student_in_session->getStudentId();
            $_SESSION['type'] = $student_in_session->getType_user();
            $_SESSION['email'] = $student_in_session->getEmail();
            header("location:". FRONT_ROOT . "Student/ShowStudentProfile");

            
        }
        
        else if($flag == 1)
        { 
           
            $user_in_session = $users->searchUser($user_mail);
            $_SESSION['email'] = $user_mail;
            $_SESSION['type'] = $user_in_session->getType_user();
            header("location:". FRONT_ROOT . "User/ShowUserProfile");
        }
        else
        {
          
            echo "<script>alert('Usuario y/o contraseña incorrecto. Intente nuevamente.');</script>";
            require_once(VIEWS_PATH. "login.php");
        }
        
    
}

    public function LogOut()
    {    
         

            session_destroy();

            require_once(VIEWS_PATH. "zero.php");

          
     }
}

?>