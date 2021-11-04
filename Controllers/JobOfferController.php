<?php 

	namespace Controllers;

	use DAO\StudentDAO as StudentDAO;
	use DAO\CareerDAO as CareerDAO;
	use DAO\JobOfferDAO as JobOfferDAO;
	use Models\JobOffer as JobOffer;
	use DAO\CompanyDAO as CompanyDAO;
	use DAO\JobPositionDAO as JobPositionDAO;
	use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;
	use Models\Company as Company;
	use Models\StudentXJobOffer as StudentXJobOffer;
	use DAO\UserDAO as UserDAO;

class JobOfferController
	{
		private $jobOfferDAO;

		public function __construct(){

			$this->jobOfferDAO = new JobOfferDAO();
		}

	
		public function ApplyForJob($idJob){

			$studentXJobOffer = new StudentXJobOffer();
            $studentXJobOffer->setStudentId(1);
            $studentXJobOffer->setJobOfferId($idJob);

			$studentXJobOfferDAO = new StudentXJobOfferDAO();

			$studentXJobOfferDAO->Add($studentXJobOffer);

            header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
    //			$this->ShowListView("Postulacion exitosa");
		}
		
	}

 ?>