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

   /* public function Verify($user_mail,$password)
    {
        
        if(isset($_POST))
        {
            $users = new UserDAO();
            $flag = $users->exist($user_mail,$password);

            if($flag == 0)
            {
                $user_in_session = $users->searchUser($user_mail);
                $_SESSION['email'] = $user_mail;
                echo $user_in_session->getType_user();
                $_SESSION['type_user'] = $user_in_session->getType_user();

                //$_SESSION['logueado'] = 1;
                
                if( $_SESSION['type_user'] == 0)
                {
                    //require_once(VIEWS_PATH."student_profile.php");

                    //usamos header xq si no, la URL queda en Login/Verify. 

                    header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
                    
                }
                else if($_SESSION['type_user'] == 1)
                {
                    header("location:". FRONT_ROOT . "Company/ShowAddView");
                }
                
            }
            else
            {
              
                echo "no existe";
                require_once(VIEWS_PATH. "login.php");
            }
        }
    }
*/

    public function Verify($user_mail,$password)
    {
        
        if(isset($_POST))
        {
            $users = new UserDAO();
            $students = new StudentDAO();
            $flag = $users->exist($user_mail,$password);
            $user_in_session = null;

            if($flag == 0)
            {

                $user_in_session = $users->searchUser($user_mail);
                $_SESSION['email'] = $user_mail;
                $_SESSION['type'] = $user_in_session->getType_user();
                header("location:". FRONT_ROOT . "Company/ShowAddView");
                
                
            }
            else if($flag == 1)
            {
                $user_in_session = $students->searchStudent($user_mail);
                $_SESSION['email'] = $user_mail;
                $_SESSION['type'] = $user_in_session->getType_user();
                header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
            }
            else
            {
              
                echo "no existe";
                require_once(VIEWS_PATH. "login.php");
            }
        }
    }

    public function LogOut()
    {    
            session_start();

            session_destroy();

            require_once(VIEWS_PATH. "login.php");

           // header("location: " . FRONT_ROOT . "Home/Index");
     }
}

?>