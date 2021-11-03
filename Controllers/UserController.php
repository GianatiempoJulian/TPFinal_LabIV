<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

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

        public function Add($firstname,$lastname,$email, $password)
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
        }

    }
?>