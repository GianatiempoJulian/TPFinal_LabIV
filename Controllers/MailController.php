<?php 

	namespace Controllers;

    use DAO\MailDAO as MailDAO;

    class MailController
	{
        private $mailDAO;

		public function __construct(){

			$this->mailDAO = new MailDAO();
		}

		

		public function NewMailView($email)
		{
			$this->mailDAO->SendNewMail($email);
		}
    }

?>