<?php
    namespace Controllers;

    //! Modelos:
    use Models\Administrator as Administrator;

    //! DAO's:
    use DAO\AdministratorDAO as AdministratorDAO;
    use DAO\StudentDAO as StudentDao;
    use DAO\MessageDAO as MessageDAO;

    class AdministratorController
    {
        private $administratorDAO;

        //! Constructor:
        //! =================================================================================================
        public function __construct()
        {
            $this->administratorDAO = new AdministratorDAO();
        }
        //! =================================================================================================

        //! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar administrador

        public function showAddView()
        {
            require_once(VIEWS_PATH."/administrator/add.php");
        }

        //? Vista lista de administradores.

        public function showListView()
        {
            if($_SESSION) {
                $administratorList = $this->administratorDAO->getAll();
                require_once(VIEWS_PATH."administrator-list.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //? Vista ver perfil administrador en sesión.

        public function showAdministratorProfile()
        {
            if($_SESSION) {
                $administrator = $this->administratorDAO->searchByEmail($_SESSION['email']);
                require_once(VIEWS_PATH. "/administrator/profile.php");
            } else {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }

        //! =================================================================================================

        //! Funciones CRUD:
        //! =================================================================================================

        //? Agregar administrador

        public function add($firstname,$lastname,$email, $password,)
        {   
            $flag = 1;
            $student_api = new StudentDAO(); 
            $student_list = $student_api->GetAllFromApi();

            foreach ($student_list as $student_from_api)
            {
                if ($student_from_api->getEmail() == $email )
                {   
                    $flag = 0;
                }
             }
             if($flag == 1)
             {
                try
                {
                    $administrator = new Administrator();
                    $administrator->setFirstname($firstname);
                    $administrator->setLastname($lastname);
                    $administrator->setEmail($email);
                    $administrator->setPassword($password);
                    $isEmailUsed = $this->administratorDAO->add($administrator);
                    if($isEmailUsed == 1)
                    {
                        echo "<script>alert('El correo esta en uso.');</script>";
                        if($_SESSION)
                        {
                            $this->ShowAddView();
                        }
                        else
                        {
                            require_once(VIEWS_PATH. "/auth/register.php");
                        }
                    }
                    else
                    {
                        echo "<script>alert('El administrador se ha registrado con exito');</script>";
                        if($_SESSION)
                        {
                            $this->ShowAddView();
                        }
                        else
                        {
                            require_once(VIEWS_PATH. "/auth/login.php");
                        }
                        
                    }
                  
                }catch(Exception $err)
                {
                    throw new Exception('Error al crear administrador.');
                }
             }
             if ($flag == 0)
             {
                echo "<script>alert('El email ingresado pertenece a un alumno');</script>";
                $this->ShowAddView();    
            }
        }
        //! =================================================================================================

    }
?>