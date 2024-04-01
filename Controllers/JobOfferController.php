<?php 

	namespace Controllers;

	//! Configuraciones:
	use Config\Autoload as Autoload;
	use Exception;

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
	use DAO\MessageDAO as MessageDAO;
	use Models\Career;

	class JobOfferController
	{
		private $jobOfferDAO;

		//! Constructor:
        //! =================================================================================================
		public function __construct() {
			$this->jobOfferDAO = new JobOfferDAO();
		}

		//! =================================================================================================

        //! =================================================================================================

		//! Llamados a vistas:
        //! =================================================================================================

        //? Vista agregar oferta laboral.

		public function showAddView()
		{
			if ($_SESSION) {
				if ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {
					require_once(VIEWS_PATH . "/joboffer/add.php");
				} else {
					$messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
				}
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}
		}

		
		//? Vista agregar foto a oferta laboral.
		
		public function showAddImageView()
		{
			if($_SESSION) {
				if($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {
                	require_once(VIEWS_PATH. "/joboffer/add-image.php");
            	} else {
                    $messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
                }
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
            }
		}

		//? Vista dar de baja oferta laboral.

		public function showRemoveView()
		{
			if ($_SESSION) {
				if ($_SESSION['type'] != 0) {
					$jobOfferList = $this->jobOfferDAO->getAll();
					$companyDAO = new CompanyDAO();

					if ($_SESSION['type'] == 1) {
						$companies = $companyDAO->getAll();
						require_once(VIEWS_PATH . "/joboffer/remove.php");
					} else {
						$c = $companyDAO->getById($_SESSION['id']);
						require_once(VIEWS_PATH . "/joboffer/remove-from-company.php");
					}
				} else {
					$messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
				}
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}
		}

		//? Vista dar de baja oferta laboral expirada.

		public function showRemoveView2()
		 { 
			if($_SESSION) {
				if($_SESSION['type'] == 1) {
					$this->removeDate();
				} else {
					$messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
				}
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}	
		 }

		
		//? Vista modificar oferta laboral.

		public function showModifyView($jobOfferId)
        {
			if($_SESSION)
            {
				if($_SESSION['type'] == 1 || $_SESSION['type'] == 2)
				{
					$jobOfferList = $this->jobOfferDAO->getAll();
					$jobOfferAux = new JobOffer();

					$compDAO = new CompanyDAO();
					$companyList = $compDAO->getAll();
					$companyAux = new Company();

					$jobPosition = new JobPositionDAO();
					$jobPositionList = $jobPosition->getAll();
					$jobPositionAux = new JobPosition();

					foreach ($jobOfferList as $jo)
					{
						if ($jo->getId() == $jobOfferId)
						{
							$jobOfferAux = $jo;
						}
					}
					foreach($companyList as $co)
					{
						if ($jobOfferAux->getCompanyId() == $co->getId())
						{
							$companyAux = $co;
						}
					}
					foreach ($jobPositionList as $jp)
					{
						if ($jo->getJobPositionId() == $jp->getId())
						{
							$jobPositionAux = $jp;
						}
					}
					require_once(VIEWS_PATH. "/joboffer/modify.php");
				}
				else
				{
					$messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
				}
            }
            else
            {
                $messageDAO = (new MessageDAO())->notLoggedMessage();
            }
        }



        //? Vista lista ofertas laborales.

		public function showListView()
		{
			if ($_SESSION) {
				$jobOfferRepository = new JobOfferDAO();
				$jobOfferList = $jobOfferRepository->getAll();

				$jobPositionRepository = new JobPositionDAO();
				$jobPositionList = $jobPositionRepository->getAll();
				$jobPositionAux = new JobPosition();

				$companyRepository = new CompanyDAO();
				$companyList = $companyRepository->getAll();
				$companyAux = new Company();

				$studentDAO = new StudentDAO();
				$studentAux = $studentDAO->getByEmail($_SESSION['email']);

				require_once(VIEWS_PATH . "joboffer/full-list.php");
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}
		}

        //? Ver ofertas de determinada empresa.

		public function showOffers($id)
		{
			if ($_SESSION) {
				$jobOfferList = $this->jobOfferDAO->getAll();
				
				$jobPositionDAO = new JobPositionDAO();
				$jobPositionList = $jobPositionDAO->getAll();
				$jobPositionAux = new JobPosition();

				$companyDAO = new CompanyDAO();
				$companyList = $companyDAO->getAll();
				$company = $companyDAO->getById($id);

				$studentDAO = new StudentDAO();
				$student = $studentDAO->getByEmail($_SESSION['email']);

				require_once(VIEWS_PATH . "/joboffer/list.php");
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}
		}

        //! =================================================================================================

		//! Funciones CRUD:
        //! =================================================================================================

		//? Dar de baja oferta laboral.

		public function remove($jobOfferId)
		{
			$jobOffer = $this->jobOfferDAO->getById($jobOfferId);
			$companyDAO = new CompanyDAO();
			$company = $companyDAO->getById($jobOffer->getCompanyId());

			$studentXJobDAO = new StudentXJobOfferDAO(); 
			$studentJobList = $studentXJobDAO->getByJobOfferId($jobOfferId); /// Obtengo la oferta a remover en la tabla intermedia, para desvincularla del usuario y notificar al estudiante.

			$studentDAO = new StudentDAO();
			$mailRepository = new MailDAO();

			$studentIds = array();

			$msg = 'La oferta [' . $jobOffer->getDescription(). '] de la empresa ['. $company->getName() .'] en la que estabas postulado fue dada de baja o ha expirado. Gracias por participar en nuestra busqueda!</b>';
			$subject = "Oferta expirada";
			
			foreach ($studentJobList as $studentJob) {  //Recorro la lista de student_x_jobOffer
				$student = $studentDAO->getById($studentJob->getStudentId()); //Obtenemos el id del estudiante que se postulo al jobOffer
				$mailRepository->sendNewMail($student->getEmail(),$msg, $subject);
				$studentIds[] = $student->getRecordId();
			}

			/*
			foreach ($studentIds as $studentId)
			{
				$studentXJobDAO->remove($studentId, $jobOfferId);
			}
			*/
			$this->jobOfferDAO->remove($jobOfferId);
			
			echo "<script>alert('Oferta eliminada con éxito');</script>";

			if ($_SESSION['type'] == 2) {
				$this->showOffers($_SESSION['id']);
			}

			$this->showListView();
		}


		//? Dar de baja oferta laboral expirada.

		public function removeDate()
		{
			$jobOfferList = $this->jobOfferDAO->getAll();

			foreach ($jobOfferList as $jobOffer) {
				if ($jobOffer->getDate() <= date("Y-m-d")) {
					$this->jobOfferDAO->remove($jobOffer->getId());
				}
			}

			$userType = $_SESSION['type'];

			switch ($userType) {
				case 0:
					header("location:" . FRONT_ROOT . "Student/ShowStudentProfile");
					break;
				case 1:
					header("location:" . FRONT_ROOT . "Administrator/ShowAdministratorProfile");
					break;
				case 2:
					header("location:" . FRONT_ROOT . "Company/ShowCompanyById/{$_SESSION['id']}");
					break;
				default:
					echo "<script>window.history.go(-1);</script>";
					break;
			}
		}


		//? Dar de baja oferta laboral expirada con inclusión de usuario y demás.

		public function removeWithDate()
        {
			$JOlist= $this->jobOfferDAO->getAll();
			$companyDAO = new CompanyDAO();
			
			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->getAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->getAll();


			foreach ($student_job_list as $student_job)  //Recorro la lista de student_x_jobOffer
					{  
						foreach ($JOlist as $jo) 
						{
							if ($jo->getDate() <= date("Y-m-d") && $student_job->getJobOfferId() == $jo->getId()) 
							{ 	
								$student_id = $student_job->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
								foreach ($studentList as $student) //Recorremos la lista de estudiantes
								{  
									if ($student->getStudentId() == $student_id) //busco en la lista de student, cuando el id del student sea =
									{  
										$joAux = $this->jobOfferDAO->searchOfferById($jo->getId());
										$JOcompany = $companyDAO->getById($joAux->getCompanyId());
										$email = $student->getEmail();
										$mailrepository = new MailDAO();
										$subject = "Oferta expirada";
										$msg = 'La oferta [' . $jo->getDescription(). '] de la empresa ['. $JOcompany->getName() .'] en la que estabas postulado fue dada de baja o ha expirado. Gracias por participar en nuestra busqueda!</b>';
										$mailrepository->sendNewMail($email,$msg, $subject);
										$this->jobOfferDAO->remove($jo->getId());
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
						header("location:". FRONT_ROOT . "Administrator/ShowUserProfile");
					}
					else if ($_SESSION['type'] == 2)
					{
						header("location:". FRONT_ROOT . "Company/ShowCompanyProfile");

					}
        }


		//? Modificar oferta laboral.

		public function modify($id,$idCompany,$idJobPosition,$fecha,$description,$image)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setId($id);
            $jobOffer->setJobPositionId($idJobPosition);
            $jobOffer->setCompanyId($idCompany);
            $jobOffer->setDate($fecha);
            $jobOffer->setDescription($description);
			$jobOffer->setActive(true);
			$jobOffer->setImage($image);

            $this->jobOfferDAO->modify($jobOffer);

			if($_SESSION['type'] == 2){
				$this->showOffers($_SESSION['id']);
			} else {
				$this->showListView();
			}
        }

		//? Agregar oferta laboral.

		public function add($jobPositionId, $companyId,$date,$description)
        {
            if(isset($_POST))
            {
				$offer = new JobOffer();
                $offer->setJobPositionId($jobPositionId);
                $offer->setCompanyId($companyId);
				$offer->setDate($date);
				$offer->setDescription($description);
                $offer->setActive(true);
				$offer->setImage(' ');
                $this->jobOfferDAO->Add($offer);
				$id = $this->jobOfferDAO->last();
				$this->showAddImageView(); 
            }
			else
			{
				echo "<script>alert('Error en el envio de datos. Intente nuevamente.');</script>";
				$this->showAddView();
			}
		}

		//? Agregar oferta laboral.

		
		public function addImage()
        {
			if(!empty($_FILES)){
				$jobOfferId = $this->jobOfferDAO->last();
				$jo = new JobOffer();
				$jo = $this->jobOfferDAO->getByID($jobOfferId);
				$file = $_FILES['image'];
				$fileName = $file['name'];
				$fileTmpRoute = $file['tmp_name'];
				$folderToSaveImg = $_SERVER['DOCUMENT_ROOT'].'/UTN/TPFinal_LabIV/Views/img/joboffer-flyers/';
				move_uploaded_file($fileTmpRoute, $folderToSaveImg.$fileName);
				$image = IMG_PATH. "joboffer-flyers/" .$fileName;
				$jo->setImage($image);
				$this->jobOfferDAO->modify($jo);
				echo "<script>alert('Oferta agregada con exito');</script>";
				$this->showAddView(); 
			} else {
				echo "<script>alert('Error en el envio de datos. Intente nuevamente.');</script>";
				$this->showAddView();
			}
		}
         
        //! =================================================================================================
		//! Funciones especificas:
        //! =================================================================================================
 
		//? Aplicar para una oferta laboral.

		public function applyForJob($idJob)
		{
			$studentXJobOffer = new StudentXJobOffer();
			$studentXJobOfferDAO = new StudentXJobOfferDAO();

			$isPostuled = $studentXJobOfferDAO->isPostuled($_SESSION['id'], $idJob);

			if($isPostuled != true) {
				$studentXJobOffer->setStudentId($_SESSION['id']);
				$studentXJobOffer->setJobOfferId($idJob);
				$studentXJobOfferList = $studentXJobOfferDAO->getAll();
				$flag = 0;
				$studentXJobOfferDAO->add($studentXJobOffer);
				echo "<script>alert('Postulacion exitosa');</script>";
			} else {
				echo "<script>alert('Ya estas postulado a esta oferta.');</script>";
			}
			$this->showListView(); 
		}

		//? Ver estudiantes postulados de una oferta mediante su ID.

		public function showStudents($id)
		{
			if($_SESSION) {
				//Job Offer
				$studentDAO = new StudentDAO();
				$studentList = $studentDAO->getAll();
				 
				//Job Position para printear nombre posicion
				$jobPositionDAO = new JobPositionDAO();
				$jobPositionList = $jobPositionDAO->getAll();
 
				//SxJO para buscar ID estudiante vinculado a una oferta
				$studentOfferDAO = new StudentXJobOfferDAO();
				$studentOfferList = $studentOfferDAO->getAll();

				//Career para mostrar carrera del estudiante.
				$careerDAO = new CareerDAO();
				$careerList = $careerDAO->getAll();
 
				//Career para guardar el nombre
				$careerAux = new Career();
 
				//JO para buscar la oferta con la ID que nos enviaron
				$jobOffer = $this->jobOfferDAO->getById($id);
				require_once(VIEWS_PATH. "/joboffer/students-postulated.php");
			 } else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			 }
		}

		//? Listado estudiantes PDF

		public function PDFStudents($offerId)
		{
			if($_SESSION) {
				$offer = $this->jobOfferDAO->getByID($offerId);
				$companyDAO = new CompanyDAO();
				$company = $companyDAO->getById($offer->getCompanyId());
				$offerName = $offer->getDescription();
				$companyName = $company->getName();
				require_once(VIEWS_PATH. "/joboffer/pdf-report.php");
			 } else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			 }
		}

		//? Declinar oferta por administrador

		public function denyApplyByAdmin($studentId, $jobOfferId)
		{
			if($_SESSION) {
				$sxjDAO = new StudentXJobOfferDAO();
				$studentDAO = new StudentDAO();
				$companyDAO = new CompanyDAO();

				$student = $studentDAO->getById($studentId);
				$jobOffer = $this->jobOfferDAO->getById($jobOfferId);
				$company = $companyDAO->getById($jobOffer->getCompanyId());

				$sxjDAO->remove($studentId, $jobOfferId);
				$msg = 'Tu postulacion hacia la oferta [' . $jobOffer->getDescription(). '] de la empresa ['. $company->getName() .'] fue declinada por un administrador. Gracias por participar en nuestra busqueda!</b>';
				$subject = "Oferta declinada";
				$email = $student->getEmail();
				$mailrepository = new MailDAO();
				$mailrepository->sendNewMail($email,$msg,$subject);
				echo "<script>alert('Postulación declinada con exito');</script>";
            	$this->showListView();
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			 }
		}
		
        //! =================================================================================================
}
 ?>