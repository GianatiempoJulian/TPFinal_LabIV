<?php 

	namespace Controllers;

	//! DAO's:
    use DAO\MailDAO as MailDAO;

    class MailController
	{
        private $mailDAO;

		//! Constructor:
        //! =================================================================================================
		public function __construct(){

			$this->mailDAO = new MailDAO();
		}
        //! =================================================================================================

		//! Funciones especificas:
        //! =================================================================================================
		public function newMailView($email)
		{
			$this->mailDAO->sendNewMail($email);
		}
        //! =================================================================================================
    }

?>