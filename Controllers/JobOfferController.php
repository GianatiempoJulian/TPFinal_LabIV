<?php 

	namespace Controllers;

	//! Configuraciones:
	use Config\Autoload as Autoload;
	use Exception\Exception;

	//! Modelos:
	use Models\JobOffer as JobOffer;
	use Models\Company as Company;
	use Models\StudentXJobOffer as StudentXJobOffer;
	use Models\JobPosition as JobPosition;
	use Models\Student as Student;

	//! DAO's:
	use DAO\StudentDAO as StudentDAO;
	use DAO\CareerDAO as CareerDAO;
	use DAO\JobOfferDAO as JobOfferDAO;
	use DAO\CompanyDAO as CompanyDAO;
	use DAO\JobPositionDAO as JobPositionDAO;
	use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;
	use DAO\UserDAO as UserDAO;
	use DAO\MailDAO as MailDAO;
	use Models\Career;

	class JobOfferController
	{
		private $jobOfferDAO;

		//! Constructor:
        //! =================================================================================================
		public function __construct(){

			$this->jobOfferDAO = new JobOfferDAO();
		}
        //! =================================================================================================

		//! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar oferta laboral.

		public function ShowAddView()
		{
			if($_SESSION)
            {
				if($_SESSION['type'] == 1 || $_SESSION['type'] == 2) 
				{
                	require_once(VIEWS_PATH. "/joboffer/add.php");
            	}
				else
                {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
                }
			}
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
		}

		
		//? Vista agregar foto a oferta laboral.
		
		public function ShowAddImageView($id)
		{
			if($_SESSION)
            {
				if($_SESSION['type'] == 1 || $_SESSION['type'] == 2) 
				{
                	require_once(VIEWS_PATH. "/joboffer/add-image.php");
            	}
				else
                {
                    echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
                    echo "<script>window.history.go(-1)</script>";
                }
			}
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
		}

		//? Vista dar de baja oferta laboral.

		public function ShowRemoveView()
		 {
			if($_SESSION)
			{
				if($_SESSION['type'] != 0)
				{
					if($_SESSION['type'] == 1)
					{
						$jo_list = $this->jobOfferDAO->getByStatus(1);
						$companyDAO = new CompanyDAO();
						$companies = $companyDAO->GetAll();
						require_once(VIEWS_PATH. "/joboffer/remove.php");
					}
					else
					{
						$jo_list = $this->jobOfferDAO->getByStatus(1);
						$companyDAO = new CompanyDAO();
						$c = $companyDAO->GetById($_SESSION['id_comp']);
						require_once(VIEWS_PATH. "/joboffer/remove-from-company.php");
					}
				}	
				else
				{
					echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
					echo "<script>window.history.go(-1)</script>";
				}
			}
			else
			{
				header("location:". FRONT_ROOT . "Home/Index?status=0");
			}
		 }

		//? Vista dar de baja oferta laboral expirada.

		public function ShowRemoveView2()
		 {
			 
			if($_SESSION)
			{
				if($_SESSION['type'] == 1)
				{
					$this->RemoveDate();
				}
				else
				{
					echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
					echo "<script>window.history.go(-1)</script>";
				}
			}
			else
			{
				header("location:". FRONT_ROOT . "Home/Index?status=0");
			}	
		 }
 
		//? Vista dar de alta oferta laboral.
 
		public function showAltaView()
		 { 
			if($_SESSION)
			{
				if($_SESSION['type'] != 1)
				{
					if($_SESSION['type'] == 1)
					{
						$jo_list = $this->jobOfferDAO->getByStatus(0);
						$companyDAO = new CompanyDAO();
						$companies = $companyDAO->GetAll();
						require_once(VIEWS_PATH. "/joboffer/alta.php");
					}
					else
					{
						$jo_list = $this->jobOfferDAO->getByStatus(0);
						$companyDAO = new CompanyDAO();
						$c = $companyDAO->GetById($_SESSION['id_comp']);
						require_once(VIEWS_PATH. "/joboffer/alta-from-company.php");
					}
				}
				else
				{
					echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
					echo "<script>window.history.go(-1)</script>";
				}
			}
			else
			{
				header("location:". FRONT_ROOT . "Home/Index?status=0");
			}
		 }

		//? Vista modificar oferta laboral.

		public function showModifyView($id_job_offer)
        {
			if($_SESSION)
            {
				if($_SESSION['type'] == 1 || $_SESSION['type'] == 2)
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
					require_once(VIEWS_PATH. "/joboffer/modify.php");
				}
				else
				{
					echo "<script>alert('Acceso no permitido para estudiantes.');</script>";
					echo "<script>window.history.go(-1)</script>";
				}
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Vista lista ofertas laborales.

		public function ShowListView()
        {
			if($_SESSION)
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
					if ($stu->getEmail() == $_SESSION['email'])
					{
						$student_aux = $stu;
					}
				}

				require_once(VIEWS_PATH."joboffer/full-list.php");
				
				
            }
            else
            {
                header("location:". FRONT_ROOT . "Home/Index?status=0");
            }
        }

        //? Ver ofertas de determinada empresa.

		public function ShowOffers($id)
		{
			if($_SESSION)
			{
				$jo_list = $this->jobOfferDAO->GetAll();
 
				$jobPosition_repository = new JobPositionDAO();
				$jobPosition_list = $jobPosition_repository->GetAll();
				$jobPosition_aux = new JobPosition();
				
				$company_repository = new CompanyDAO();
				$company_list = $company_repository->GetAll();
				$company = new Company();

				$comp = $company_repository->GetById($id);

				$student_repository = new StudentDAO();
				$student_list = $student_repository->GetAll();
				$student_aux = new Student();
	
				foreach($student_list as $stu)
				{
					if ($stu->getEmail() == $_SESSION['email']){
						$student_aux = $stu;
					}
				}

				require_once(VIEWS_PATH. "/joboffer/list.php");
				
			}
			else
			{
				header("location:". FRONT_ROOT . "Home/Index?status=0");
			}          
		}
        //! =================================================================================================

		//! Funciones CRUD:
        //! =================================================================================================

		//? Dar de baja oferta laboral.

		public function Remove($job_offer_id)
        {
			$JOlist= $this->jobOfferDAO->GetAll();
			$JO = $this->jobOfferDAO->SearchOfferById($job_offer_id);
			$companyDAO = new CompanyDAO();
			$JOcompany = $companyDAO->GetById($JO->getIdCompany());
 
			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->GetAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->GetAll();


			foreach ($student_job_list as $student_job)  //Recorro la lista de student_x_jobOffer
					{  
						if ($student_job->getJobOfferId() == $job_offer_id) //busco en la lista de student_x_jobOffer, cuando el id del offer sea =
						{ 	
							$student_id = $student_job->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
							foreach ($studentList as $student) //Recorremos la lista de estudiantes
							{  
								if ($student->getStudentId() == $student_id){  //busco en la lista de student, cuando el id del student sea =
										$email = $student->getEmail();
										$mailrepository = new MailDAO();
										$mailrepository->SendNewMail($email,$JO->getDescription(),$JOcompany->getComp_name());
									}
								}
							}
						}

            $this->jobOfferDAO->Remove($job_offer_id);
			echo "<script>alert('Oferta eliminada con exito');</script>";
			if($_SESSION['type'] == 2){
				$this->ShowOffers($_SESSION['id_comp']);

			}
            $this->ShowListView();
         
        }

		//? Dar de baja oferta laboral con email.

		public function RemoveDateWithEmail()
        {
		
			$JOlist= $this->jobOfferDAO->GetAll();
			$id_busqueda = null;

			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->GetAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->GetAll();

			$companyDAO = new CompanyDAO();

			foreach ($JOlist as $jo){
				if ($jo->getFecha() <= date("Y-m-d") && $jo->GetActive() == 1)
				{	
					$id_busqueda = $jo->getId(); // Obtengo la id del job offer que se va a eliminar
					$JOcompany = $companyDAO->GetById($jo->getIdCompany());

					foreach ($student_job_list as $list2)  //Recorro la lista de student_x_jobOffer
					{  
						if ($list2->getJobOfferId() == $id_busqueda) //busco en la lista de student_x_jobOffer, cuando el id del offer sea =
						{ 	
							$student_id = $list2->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
							foreach ($studentList as $list3) //Recorremos la lista de estudiantes
							{  
								if ($list3->getStudentId() == $student_id){  //busco en la lista de student, cuando el id del student sea =
										$email = $list3->getEmail();
										$mailrepository = new MailDAO();
										$mailrepository->SendNewMail($email, $jo->getDescription(),$JOcompany->getComp_name());
									}
								}
							}
						}
						$this->jobOfferDAO->Remove($jo->getId());
					}
			}
            $this->ShowListView();
        }

		//? Dar de baja oferta laboral expirada.
		
		public function RemoveDate()
        {
			$JOlist=$this->jobOfferDAO->GetAll();
			foreach ($JOlist as $list)
			{
				if ($list->getFecha() <= date("Y-m-d"))
				{	
					$this->jobOfferDAO->Remove($list->getId());
				}
			}
			if($_SESSION['type'] == 0)
			{
				header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
			}
			else if($_SESSION['type'] == 1)
			{
				header("location:". FRONT_ROOT . "User/ShowUserProfile");
			}
			else if($_SESSION['type'] == 2)
			{
            	header("location:". FRONT_ROOT . "Company/ShowCompanyById/$_SESSION[id_comp]");
			}
    
        }

		//? Dar de baja oferta laboral expirada con inclusión de usuario y demás.

		public function RemoveWithDate()
        {
			$JOlist= $this->jobOfferDAO->GetAll();
			$companyDAO = new CompanyDAO();
			
			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->GetAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->GetAll();


			foreach ($student_job_list as $student_job)  //Recorro la lista de student_x_jobOffer
					{  
						foreach ($JOlist as $jo) 
						{
							if ($jo->getFecha() <= date("Y-m-d") && $student_job->getJobOfferId() == $jo->getId()) 
							{ 	
								$student_id = $student_job->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
								foreach ($studentList as $student) //Recorremos la lista de estudiantes
								{  
									if ($student->getStudentId() == $student_id) //busco en la lista de student, cuando el id del student sea =
									{  
										$joAux = $this->jobOfferDAO->SearchOfferById($jo->getId());
										$JOcompany = $companyDAO->GetById($joAux->getIdCompany());
										$email = $student->getEmail();
										$mailrepository = new MailDAO();
										$msg = 'La oferta [' . $jo->getDescription(). '] de la empresa ['. $JOcompany->getComp_name() .'] en la que estabas postulado fue dada de baja o ha expirado. Gracias por participar en nuestra busqueda!</b>';
										$mailrepository->SendNewMail($email,$msg);
										$this->jobOfferDAO->Remove($jo->getId());
									}
								}
							}
						}
					}
					
					if($_SESSION['type'] == 0)
					{
						header("location:". FRONT_ROOT . "Student/ShowStudentProfile");
					}
					else if($_SESSION['type'] == 1)
					{
						header("location:". FRONT_ROOT . "User/ShowUserProfile");
					}
					else if ($_SESSION['type'] == 2)
					{
						header("location:". FRONT_ROOT . "Company/ShowCompanyProfile");

					}
        }

	

		//? Dar de alta oferta laboral.

		public function Alta($job_offer_id)
        {
            $this->jobOfferDAO->Alta($job_offer_id);
			echo "<script>alert('Oferta dada de alta con exito');</script>";
            if($_SESSION['type'] == 2){
				$this->ShowOffers($_SESSION['id_comp']);

			}
            $this->ShowListView();
         
        }

		//? Modificar oferta laboral.

		public function Modify($o_id,$o_idCompany,$o_idJobPosition,$o_fecha,$o_description,$o_image)
        {
		
            $jo_modify = new JobOffer();

            $jo_modify->setId($o_id);
            $jo_modify->setIdJobPosition($o_idJobPosition);
            $jo_modify->setIdCompany($o_idCompany);
            $jo_modify->setFecha($o_fecha);
            $jo_modify->setDescription($o_description);
			$jo_modify->setActive(true);
			$jo_modify->setImage($o_image);


            $this->jobOfferDAO->Modify($jo_modify);

			if($_SESSION['type'] == 2){
				$this->ShowOffers($_SESSION['id_comp']);
			}
			else{
				$this->ShowListView();
				
			}
            
            
        }

		//? Agregar oferta laboral.

		public function Add($id_jp, $id_com,$fecha,$description)
        {
            if(isset($_POST))
            {
                $id = $this->jobOfferDAO->CountOffers()+1;
				$offer = new JobOffer();
                $offer->setId($id);
                $offer->setIdJobPosition($id_jp);
                $offer->setIdCompany($id_com);
				$offer->setFecha($fecha);
				$offer->setDescription($description);
                $offer->setActive(true);
				$offer->setImage(' ');
                $this->jobOfferDAO->Add($offer);
		
				/*
				echo "<script>alert('Oferta agregada con exito');</script>";
                $this->ShowAddView(); */
				$this->ShowAddImageView($id); 
            }
			else
			{
				echo "<script>alert('Error en el envio de datos. Intente nuevamente.');</script>";
				$this->ShowAddView();
			}
		}

		//? Agregar oferta laboral.

		
		public function AddImage()
        {
			if(!empty($_FILES))
			{
					$jo_id = $this->jobOfferDAO->last();
					$jo = new JobOffer();
					$jo = $this->jobOfferDAO->SearchOfferById($jo_id);
					$file = $_FILES['o_image'];
					$fileName = $file['name'];
					$fileTmpRoute = $file['tmp_name'];
					$folderToSaveImg = $_SERVER['DOCUMENT_ROOT'].'/UTN/TPFinal_LabIV/Views/img/joboffer-flyers/';
					move_uploaded_file($fileTmpRoute, $folderToSaveImg.$fileName);
					$image = IMG_PATH. "joboffer-flyers/" .$fileName;
					$jo->setImage($image);
					$this->jobOfferDAO->Modify($jo);
					echo "<script>alert('Oferta agregada con exito');</script>";
					$this->ShowAddView(); 
				}
				else
				{
					echo "<script>alert('Error en el envio de datos. Intente nuevamente.');</script>";
					$this->ShowAddView();
				}
			
		}
         
        

        //! =================================================================================================
		//! Funciones especificas:
        //! =================================================================================================
 

		//? Aplicar para una oferta laboral.

		public function ApplyForJob($idJob)
		{
			$studentXJobOffer = new StudentXJobOffer();
			$studentXJobOfferDAO = new StudentXJobOfferDAO();

			$isPostuled = $studentXJobOfferDAO->isPostuled($_SESSION['id_student'], $idJob);

			if($isPostuled != true)
			{
				$studentXJobOffer->setStudentId($_SESSION['id_student']);
				$studentXJobOffer->setJobOfferId($idJob);
				$studentXJobOfferList = $studentXJobOfferDAO->GetAll();
				$flag = 0;
				$studentXJobOfferDAO->Add($studentXJobOffer);
				echo "<script>alert('Postulacion exitosa');</script>";
			}
			else{
				echo "<script>alert('Ya estas postulado a esta oferta.');</script>";
			}
		
			$this->ShowListView(); 
			
		}

		//? Ver estudiantes postulados de una oferta mediante su ID.

		public function ShowStudents($id)
		{
			if($_SESSION)
			 {
				 //Job Offer
				 $student_repository = new StudentDAO();
				 $student_list = $student_repository->GetAll();
				 
				 //Job Position para printear nombre posicion
				 $jobPosition_repository = new JobPositionDAO();
				 $jobPosition_list = $jobPosition_repository->GetAll();
 
				 //SxJO para buscar ID estudiante vinculado a una oferta
				 $student_x_offer = new StudentXJobOfferDAO();
				 $student_x_offer_list = $student_x_offer->GetAll();

				 //Career para mostrar carrera del estudiante.
				 $career_repository = new CareerDAO();
				 $career_list = $career_repository->GetAll();
 
				 //Career para guardar el nombre
				 $career_aux = new Career();
 
				 //JO para buscar la oferta con la ID que nos enviaron
				 $jo = $this->jobOfferDAO->SearchOfferById($id);
 
				 require_once(VIEWS_PATH. "/joboffer/students-postulated.php");
			 }
			 else
			 {
				 header("location:". FRONT_ROOT . "Home/Index?status=0");
			 }
		}

		//? Listado estudiantes PDF

		public function PDFStudents($offerId)
		{
			
			if($_SESSION)
			 {
				$offer = $this->jobOfferDAO->SearchOfferById($offerId);
				$companyDAO = new CompanyDAO();
				$company = $companyDAO->GetById($offer->getIdCompany());
				$offerName = $offer->getDescription();
				$companyName = $company->getComp_name();
				require_once(VIEWS_PATH. "/joboffer/pdf-report.php");
			 }
			 else
			 {
				 header("location:". FRONT_ROOT . "Home/Index?status=0");
			 }
		}

		public function denyApplyByAdmin($studentId, $jobOfferId)
		{
			if($_SESSION)
			 {
				$sxjDAO = new StudentXJobOfferDAO();
				$studentDAO = new StudentDAO();
				$companyDAO = new CompanyDAO();

				$student = $studentDAO->searchStudentById($studentId);
				$JO = $this->jobOfferDAO->SearchOfferById($jobOfferId);
				$company = $companyDAO->GetById($JO->getIdCompany());

				$sxjDAO->Remove($studentId, $jobOfferId);
				$msg = 'Tu postulacion hacia la oferta [' . $JO->getDescription(). '] de la empresa ['. $company->getComp_name() .'] fue declinada por un administrador. Gracias por participar en nuestra busqueda!</b>';

				$email = $student->getEmail();
				$mailrepository = new MailDAO();
				$mailrepository->SendNewMail($email,$msg);
				echo "<script>alert('Postulación declinada con exito');</script>";
            	$this->ShowListView();
			 }
			 else
			 {
				 header("location:". FRONT_ROOT . "Home/Index?status=0");
			 }
		}
		
        //! =================================================================================================

	
}
 ?>