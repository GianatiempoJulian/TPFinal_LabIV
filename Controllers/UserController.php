<?php
    namespace Controllers;

    //! Modelos:
    use Models\User as User;

    //! DAO's:
    use DAO\UserDAO as UserDAO;
    use DAO\StudentDAO as StudentDao;
    use DAO\MessageDAO as MessageDAO;

    class UserController
    {
        private $userDAO;

        //! Constructor:
        //! =================================================================================================
        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }
        //! =================================================================================================

        //! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar usuario.

        public function showAddView()
        {
           
            require_once(VIEWS_PATH."/user/add.php");
            /*
            else
            {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
            }*/
        }

        //? Vista lista de usuarios.

        public function showListView()
        {
            if($_SESSION) {
                $userList = $this->userDAO->getAll();
                require_once(VIEWS_PATH."user-list.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista ver perfil usuario en sesión.

        public function showUserProfile()
        {
            if($_SESSION) {
                $user = $this->userDAO->searchUser($_SESSION['email']);
                require_once(VIEWS_PATH. "/user/profile.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //! =================================================================================================

        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar usuario.

        public function add($firstname,$lastname,$email, $password,)
        {   
            
            /*
            $flag = 1;
            $student_api = new StudentDAO(); 
            $student_list = $student_api->GetAllFromApi();

            foreach ($student_list as $student_from_api)
            {
                if ($student_from_api->getEmail() == $email )
                {   
                    $flag = 0;
                    echo $student_from_api->getEmail();
                }
             }
             if($flag == 1)
             {
                */
                 
                $user = new User();
                $user->setFirstName($firstname);
                $user->setLastName($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setType_user(1);
                $this->userDAO->add($user);
                
                echo "<script>alert('El administrador se ha registrado con exito');</script>";
                require_once(VIEWS_PATH. "/auth/login.php");

                /*
             }
             if ($flag == 0)
             {
                echo "<script>alert('El email ingresado pertenece a un alumno');</script>";
                $this->ShowAddView();    
            }*/
        }
        //! =================================================================================================

    }
?>