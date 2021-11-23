<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
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
     if($type == 1)
    {
        header("location:". FRONT_ROOT . "User/ShowAddView");
       
    }
    if($type == 2){
        header("location:". FRONT_ROOT . "Company/ShowAddView");
    }
}

public function Verify($user_mail,$password)
{
    
   
        $users = new UserDAO();
        $students = new StudentDAO();
        $company = new CompanyDAO();

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
        else  if($flag == 1)
        { 
           
            $user_in_session = $users->searchUser($user_mail);
            $_SESSION['email'] = $user_mail;
            $_SESSION['type'] = $user_in_session->getType_user();
            header("location:". FRONT_ROOT . "User/ShowUserProfile");
        }
        else if ($flag == 2){
            echo "1";
            $company_in_session = $company->SearchCompanyByEmail($user_mail);
            echo "2";
            $_SESSION['id_comp'] = $company_in_session->getComp_id();
            echo "3";
            $_SESSION['email'] = $user_mail;
            echo "4";
            $_SESSION['type'] = $company_in_session->getComp_type_int();
            echo "5";
            
            $id = $_SESSION['id_comp'];
            header("location:". FRONT_ROOT . "Company/ShowCompanyById/$id");
        
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