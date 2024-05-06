<?php

namespace Controllers;

    //! DAO's:
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\AdministratorDAO as AdministratorDAO;
    use DAO\StudentDAO as StudentDAO;   




    class LoginController
    {
        //! Llamados a vistas:
        //! =================================================================================================

        //? Vista de registro.

        public function showRegisterView (){
            require_once(VIEWS_PATH . "/auth/register.php");
        }

        //? Vista de inicio de sesión.

        public function showLoginView (){
            require_once(VIEWS_PATH . "/auth/login.php");
        }

        //! =================================================================================================

        //! Funciones especificas:
        //! =================================================================================================

        //? Reedireción según tipo de usuario.

        public function toType($type){

            if($type != NULL)
            {
                switch($type){
                    case 0:
                        header("location:". FRONT_ROOT . "Student/ShowAddView");
                        break;
                    case 1:
                        header("location:". FRONT_ROOT . "Administrator/ShowAddView");
                        break;
                    case 2:
                        header("location:". FRONT_ROOT . "Company/ShowAddView");
                        break;
                }
            }
            else
            {
                echo "<script>alert('Tipo de usuario no indicado.');</script>";
                $this->showRegisterView();
            }
        }
        
        //? Verificación de datos.

        public function verify($email,$password)
        {
            $admins = new AdministratorDAO();
            $students = new StudentDAO();
            $company = new CompanyDAO();

            $flag = $admins->exist($email,$password);
           
                
            if($flag == 0)
            {    
                $studentInSession = $students->getByEmail($email);
                session_start();
                $_SESSION['id'] = $studentInSession->getRecordId();
                $_SESSION['type'] = $flag;
                $_SESSION['email'] = $studentInSession->getEmail();
                header("location:". FRONT_ROOT . "JobOffer/removeWithDate");
            }
            else if($flag == 1)
            { 
                $adminInSession = $admins->searchByEmail($email);
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $flag;
                header("location:". FRONT_ROOT . "JobOffer/removeWithDate");                
            }
            else if ($flag == 2)
            {
                $companyInSession = $company->getByEmail($email);
                session_start();
                $_SESSION['id'] = $companyInSession->getId();
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $flag;
                $id = $_SESSION['id'];
                header("location:". FRONT_ROOT . "JobOffer/removeWithDate");

            }
            else
            {
                echo "<script>alert('Usuario y/o contraseña incorrecto. Intente nuevamente.');</script>";
                require_once(VIEWS_PATH. "/auth/login.php");
            } 
        }

        //? Cerrar sesión.

        public function logOut()
        {    
            session_destroy();
            require_once(VIEWS_PATH. "index.php");
        }
        //! =================================================================================================
    }
?>