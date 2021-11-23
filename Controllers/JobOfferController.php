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
	use Models\Student as Student;
	use Config\Autoload as Autoload;

	use DAO\MailDAO as MailDAO;




	

	
	/*
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
*/
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


			$student_repository = new StudentDAO();
			$student_list = $student_repository->GetAll();
			$student_aux = new Student();

			

			foreach($student_list as $stu)
			{
				if ($stu->getEmail() == $_SESSION['email']){
					$student_aux = $stu;
				}
			}

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

		public function ShowOffers()
		{
			 
			 $jo_list = $this->jobOfferDAO->GetAll();
 
			 
			 
			 $jobPosition_repository = new JobPositionDAO();
			 $jobPosition_list = $jobPosition_repository->GetAll();
			 $jobPosition_aux = new JobPosition();
			 
			 $company_repository = new CompanyDAO();
			 $company_list = $company_repository->GetAll();
			 $company = new Company();

			 $comp = $company_repository->GetById($id);

			
			 echo $comp->getComp_id();

			 $student_repository = new StudentDAO();
			 $student_list = $student_repository->GetAll();
			 $student_aux = new Student();
 
 
			 foreach($student_list as $stu)
			 {
				 if ($stu->getEmail() == $_SESSION['email']){
					 $student_aux = $stu;
				 }
			 }
 
			 if($_SESSION['type'] == 0)
			 {
				 require_once(VIEWS_PATH. "offer-list.php");
			 }  
			 else if($_SESSION['type'] == 1)
			 {
			   
				 require_once(VIEWS_PATH. "full-offer-list-admin.php");
			 }          
		   
		}
 

	

		public function ShowRemoveView()
        {
			require_once(VIEWS_PATH. "remove-offer.php");
        }

		public function ShowRemoveView2()
        {
			$this->RemoveDate();
			
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

			$jobPosition = new JobPositionDAO();
			$jobPositionList = $jobPosition->GetAll();
			$jp_aux = new JobPosition();




            

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

			foreach ($jobPositionList as $jp)
            {
                if ($jo->getIdJobPosition() == $jp->GetId())
                {
                    $jp_aux = $jp;
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

		

		
				$studentXJobOfferDAO->Add($studentXJobOffer);
				echo "<script>alert('Postulacion exitosa');</script>";
				header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
			
   
		
		}

		public function Remove($job_offer_id)
        {

            $this->jobOfferDAO->Remove($job_offer_id);
			echo "<script>alert('Oferta eliminada con exito');</script>";
            $this->ShowListView();
         
        }

		
		public function RemoveDateWithEmail()
        {
		
			$JOlist=$this->jobOfferDAO->GetAll();
			$id_busqueda = null;

			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->GetAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->GetAll();

			
			
			foreach ($JOlist as $list){
					if ($list->getFecha() <= date("Y-m-d") && $list->GetActive() == 1)
					{	
						
						
						$id_busqueda = $list->getId(); // Obtengo la id del job offer que se va a eliminar
						echo "antes dsexoanal2";
						foreach ($student_job_list as $list2){   //Recorro la lista de student_x_jobOffer
						;

							if ($list2->getJobOfferId() == $id_busqueda){ //busco en la lista de student_x_jobOffer, cuando el id del offer sea =
								
								$student_id = $list2->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
								echo "antes dsexo";
								foreach ($studentList as $list3){   //Recorremos la lista de estudiantes

									if ($list3->getStudentId() == $student_id){  //busco en la lista de student, cuando el id del student sea =
										//require_once(VIEWS_PATH. "send-mail.php");
										$email = $list3->getEmail();
										//require_once(FRONT_ROOT. "Mail/NewMailView/$email");


										$mailrepository = new MailDAO();
										$mailrepository->SendNewMail($email);
									
									}
								}

							}
						}


						
						$this->jobOfferDAO->Remove($list->getId());


					}
			}

			
            $this->ShowListView();


         
        }

		
		public function RemoveDate()
        {
			$JOlist=$this->jobOfferDAO->GetAll();
			
			foreach ($JOlist as $list){
				
					if ($list->getFecha() <= date("Y-m-d"))
					{	
						
						$this->jobOfferDAO->Remove($list->getId());
					}
			}

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