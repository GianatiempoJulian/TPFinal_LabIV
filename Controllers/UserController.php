<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use DAO\StudentDAO as StudentDao;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-user.php");
        }

        public function ShowListView()
        {
            $userList = $this->userDAO->GetAll();

            require_once(VIEWS_PATH."user-list.php");
        }

        public function ShowUserProfile()
        {
            $userList = $this->userDAO->GetAll();
            $user_mail = $_SESSION['email'];
            require_once(VIEWS_PATH. "user_profile.php");
        }

       /* public function Add($firstname,$lastname,$email, $password)
        {
            $user = new User();

            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setType_user(1);

            ///deberia ponerle una ID al admin
           
           
            $this->userDAO->Add($user);


            
            $this->ShowAddView();
        }*/

        public function Add($firstname,$lastname,$email, $password)
        {   
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
                
                                                                      ///deberia ponerle una ID al admin
             }
             if($flag == 1){
                 
                $user = new User();

                $user->setFirstName($firstname);
                $user->setLastName($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setType_user(1);

                echo $user->getFirstName();
                

                $this->userDAO->Add($user);
                
                echo "despues del add";
                echo "<script>alert('El administrador se ha registrado con exito');</script>";
                require_once(VIEWS_PATH. "login.php");

             }
             if ($flag == 0){
            echo "<script>alert('El email ingresado pertenece a un alumno');</script>";
            $this->ShowAddView();    
            }

        }

    }
?>