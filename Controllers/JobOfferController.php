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

		public function ShowAddView()
		{
			require_once(VIEWS_PATH. "add-offer.php");
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

			$type = $_SESSION['type'];

			if ($type == 0)
			{
				require_once(VIEWS_PATH."full-offer-list.php");
			}
			else if ($type == 1)
			{
				require_once(VIEWS_PATH."full-offer-list-admin.php");
			}
           
        }

	

		public function ShowRemoveView()
        {
			require_once(VIEWS_PATH. "remove-offer.php");
        }

        public function showAltaView()
        {
            require_once(VIEWS_PATH. "alta-offer.php");
        }

		public function showModifyView($id_job_offer)
        {

            $jobOfferList = $this->jobOfferDAO->GetAll();
			$jo_aux = new JobOffer();

			
			$compDAO = new CompanyDAO();
			$companyList = $compDAO->GetAll();
			$comp_aux = new Company();

            

            foreach ($jobOfferList as $jo)
            {
                if ($jo->getId() == $id_job_offer)
                {
                    $jo_aux = $jo;
                }
            }

			foreach($companyList as $co)
			{
				if ($jo_aux->getIdCompany() == $co->getComp_id())
				{
					$comp_aux = $co;
				}
			}


            require_once(VIEWS_PATH."edit-jobOffer.php");
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
				echo "<script>alert('Postulacion exitosa');</script>";
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
			echo "<script>alert('Oferta eliminada con exito');</script>";
            $this->ShowListView();
         
        }

		public function Alta($job_offer_id)
        {

            $this->jobOfferDAO->Alta($job_offer_id);
			echo "<script>alert('Oferta dada de alta con exito');</script>";
            $this->ShowListView();
         
        }

		public function Modify($o_id,$o_idCompany,$o_idJobPosition,$o_fecha,$o_description)
        {
		
            $jo_modify = new JobOffer();

            $jo_modify->setId($o_id);
            $jo_modify->setIdJobPosition($o_idJobPosition);
            $jo_modify->setIdCompany($o_idCompany);
            $jo_modify->setFecha($o_fecha);
            $jo_modify->setDescription($o_description);
			$jo_modify->setActive(true);


             $this->jobOfferDAO->Modify($jo_modify);

            $this->ShowListView();
            
        }

		public function Add($o_id,$id_jp, $id_com,$fecha,$description)
        {

            if(isset($_POST))
            {
                
				if($this->jobOfferDAO->SearchOfferById($o_id) == NULL)
                {
                    
					$offer = new JobOffer();
                    $offer->setId($o_id);
                    $offer->setIdJobPosition($id_jp);
                    $offer->setIdCompany($id_com);
					$offer->setFecha($fecha);
					$offer->setDescription($description);
                    $offer->setActive(true);

                    $this->jobOfferDAO->Add($offer);

					echo "<script>alert('Oferta agregada con exito');</script>";


                    $this->ShowAddView();
                
            }
			else
			{
				echo "Nombre en uso, intente con otro";
				echo "<script>alert('Nombre en uso intente con otro');</script>";
				$this->ShowAddView();
			}
		}
         
        }

		

		
	}

 ?>