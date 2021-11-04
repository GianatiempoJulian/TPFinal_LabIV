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
	use Models\JobPosition as JobPosition;

class JobOfferController
	{
		private $jobOfferDAO;

		public function __construct(){

			$this->jobOfferDAO = new JobOfferDAO();
		}

		public function ShowListView()
        {
			$jobOffer_repository = new JobOfferDAO();
            $jo_list = $jobOffer_repository->GetAll();

			$jobPosition_repository = new JobPositionDAO();
            $jobPosition_list = $jobPosition_repository->GetAll();
            $jobPosition_aux = new JobPosition();

			$company_repository = new CompanyDAO();
            $company_list = $company_repository->GetAll();
            $company_aux = new Company();

            require_once(VIEWS_PATH."full-offer-list.php");
        }

		public function ShowRemoveView()
        {
            require_once(VIEWS_PATH. "remove-offer.php");
        }

        public function showAltaView()
        {
            require_once(VIEWS_PATH. "alta-offer.php");
        }

		public function ApplyForJob($idJob){

			$studentXJobOffer = new StudentXJobOffer();
            $studentXJobOffer->setStudentId($_SESSION['id_student']);
            $studentXJobOffer->setJobOfferId($idJob);

			
 
			$studentXJobOfferDAO = new StudentXJobOfferDAO();
			$studentXJobOfferList = $studentXJobOfferDAO->GetAll();
			$flag = 0;

			foreach ($studentXJobOfferList as $sxj)
			{
				if ($sxj->getStudentId() == $studentXJobOffer->getStudentId())
				{
					$flag = 1;
				}
			}

			if ($flag == 0)
			{
				$studentXJobOfferDAO->Add($studentXJobOffer);
				header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
			}
			else
			{
				echo "Usuario ya esta postulado a un Job Offer";
				header("location:". FRONT_ROOT . "Company/ShowListView");
			}
   
		
		}

		public function Remove($job_offer_id)
        {

            $this->jobOfferDAO->Remove($job_offer_id);
            $this->ShowListView();
         
        }

		public function Alta($job_offer_id)
        {

            $this->jobOfferDAO->Alta($job_offer_id);
            $this->ShowListView();
         
        }

		

		
	}

 ?>