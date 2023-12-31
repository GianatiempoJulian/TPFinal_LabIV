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
		
		public function showAddImageView($id)
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
					$jo_list = $this->jobOfferDAO->getByStatus(1);
					$companyDAO = new CompanyDAO();

					if ($_SESSION['type'] == 1) {
						$companies = $companyDAO->getAll();
						require_once(VIEWS_PATH . "/joboffer/remove.php");
					} else {
						$c = $companyDAO->getById($_SESSION['id_comp']);
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
 
		//? Vista dar de alta oferta laboral.
 
		public function showAltaView()
		{
			$jo_list = $this->jobOfferDAO->getByStatus(0);
			$companyDAO = new CompanyDAO();

			if ($_SESSION) {
				if ($_SESSION['type'] != 0) {
					if ($_SESSION['type'] == 1) {
						$companies = $companyDAO->getAll();
						require_once(VIEWS_PATH . "/joboffer/alta.php");
					} else {
						$c = $companyDAO->getById($_SESSION['id_comp']);
						require_once(VIEWS_PATH . "/joboffer/alta-from-company.php");
					}
				} else {
					$messageDAO = (new MessageDAO())->studentAccessDeniedMessage();
				}
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			}
		}

		
		//? Vista modificar oferta laboral.

		public function showModifyView($id_job_offer)
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
						if ($jo->getId() == $id_job_offer)
						{
							$jobOfferAux = $jo;
						}
					}
					foreach($companyList as $co)
					{
						if ($jobOfferAux->getIdCompany() == $co->getComp_id())
						{
							$companyAux = $co;
						}
					}
					foreach ($jobPositionList as $jp)
					{
						if ($jo->getIdJobPosition() == $jp->getId())
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
				$studentAux = $studentDAO->searchStudent($_SESSION['email']);

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
				$student = $studentDAO->searchStudent($_SESSION['email']);

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
			$jobOffer = $this->jobOfferDAO->searchOfferById($jobOfferId);
			$companyDAO = new CompanyDAO();
			$company = $companyDAO->getById($jobOffer->getIdCompany());

			$studentXJobDAO = new StudentXJobOfferDAO(); 
			$studentJobList = $studentXJobDAO->getByJobOfferId($jobOfferId); /// Obtengo la oferta a remover en la tabla intermedia, para desvincularla del usuario y notificar al estudiante.

			$studentDAO = new StudentDAO();
			$mailRepository = new MailDAO();

			foreach ($studentJobList as $studentJob) {  //Recorro la lista de student_x_jobOffer
				$student = $studentDAO->searchStudentById($studentJob->getStudentId()); //Obtenemos el id del estudiante que se postulo al jobOffer
				$mailRepository->sendNewMail($student->getEmail(), $jobOffer->getDescription(), $company->getComp_name());
			}

			$this->jobOfferDAO->remove($jobOfferId);
			
			echo "<script>alert('Oferta eliminada con éxito');</script>";

			if ($_SESSION['type'] == 2) {
				$this->showOffers($_SESSION['id_comp']);
			}

			$this->showListView();
		}

		

		//? Dar de baja oferta laboral con email.

		public function removeDateWithEmail()
        {
			$JOlist= $this->jobOfferDAO->getAll();
			$id_busqueda = null;

			$student_job =  new StudentXJobOfferDAO();
			$student_job_list = $student_job->getAll(); /// Obtengo toda la lista de student_x_jobOffer

			$student = new StudentDAO();
			$studentList = $student->getAll();

			$companyDAO = new CompanyDAO();

			foreach ($JOlist as $jo){
				if ($jo->getFecha() <= date("Y-m-d") && $jo->getActive() == 1)
				{	
					$id_busqueda = $jo->getId(); // Obtengo la id del job offer que se va a eliminar
					$JOcompany = $companyDAO->getById($jo->getIdCompany());

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
										$mailrepository->sendNewMail($email, $jo->getDescription(),$JOcompany->getComp_name());
									}
								}
							}
						}
						$this->jobOfferDAO->remove($jo->getId());
					}
			}
            $this->showListView();
        }

		//? Dar de baja oferta laboral expirada.

		public function removeDate()
		{
			$jobOfferList = $this->jobOfferDAO->getAll();

			foreach ($jobOfferList as $jobOffer) {
				if ($jobOffer->getFecha() <= date("Y-m-d")) {
					$this->jobOfferDAO->remove($jobOffer->getId());
				}
			}

			$userType = $_SESSION['type'];

			switch ($userType) {
				case 0:
					header("location:" . FRONT_ROOT . "Student/ShowStudentProfile");
					break;
				case 1:
					header("location:" . FRONT_ROOT . "User/ShowUserProfile");
					break;
				case 2:
					header("location:" . FRONT_ROOT . "Company/ShowCompanyById/{$_SESSION['id_comp']}");
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
							if ($jo->getFecha() <= date("Y-m-d") && $student_job->getJobOfferId() == $jo->getId()) 
							{ 	
								$student_id = $student_job->getStudentId();  //Obtenemos el id del estudiante que se postulo al jobOffer
								foreach ($studentList as $student) //Recorremos la lista de estudiantes
								{  
									if ($student->getStudentId() == $student_id) //busco en la lista de student, cuando el id del student sea =
									{  
										$joAux = $this->jobOfferDAO->searchOfferById($jo->getId());
										$JOcompany = $companyDAO->getById($joAux->getIdCompany());
										$email = $student->getEmail();
										$mailrepository = new MailDAO();
										$msg = 'La oferta [' . $jo->getDescription(). '] de la empresa ['. $JOcompany->getComp_name() .'] en la que estabas postulado fue dada de baja o ha expirado. Gracias por participar en nuestra busqueda!</b>';
										$mailrepository->sendNewMail($email,$msg);
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
						header("location:". FRONT_ROOT . "User/ShowUserProfile");
					}
					else if ($_SESSION['type'] == 2)
					{
						header("location:". FRONT_ROOT . "Company/ShowCompanyProfile");

					}
        }

	

		//? Dar de alta oferta laboral.

		public function alta($jobOfferId)
        {
            $this->jobOfferDAO->alta($jobOfferId);
			echo "<script>alert('Oferta dada de alta con exito');</script>";
            if($_SESSION['type'] == 2){
				$this->showOffers($_SESSION['id_comp']);
			}
            $this->showListView();
        }


		//? Modificar oferta laboral.

		public function modify($o_id,$o_idCompany,$o_idJobPosition,$o_fecha,$o_description,$o_image)
        {
            $jo_modify = new JobOffer();
            $jo_modify->setId($o_id);
            $jo_modify->setIdJobPosition($o_idJobPosition);
            $jo_modify->setIdCompany($o_idCompany);
            $jo_modify->setFecha($o_fecha);
            $jo_modify->setDescription($o_description);
			$jo_modify->setActive(true);
			$jo_modify->setImage($o_image);

            $this->jobOfferDAO->modify($jo_modify);

			if($_SESSION['type'] == 2){
				$this->showOffers($_SESSION['id_comp']);
			} else {
				$this->showListView();
			}
        }

		//? Agregar oferta laboral.

		public function add($id_jp, $id_com,$fecha,$description)
        {
            if(isset($_POST))
            {
                $id = $this->jobOfferDAO->countOffers()+1;
				$offer = new JobOffer();
                $offer->setId($id);
                $offer->setIdJobPosition($id_jp);
                $offer->setIdCompany($id_com);
				$offer->setFecha($fecha);
				$offer->setDescription($description);
                $offer->setActive(true);
				$offer->setImage(' ');
                $this->jobOfferDAO->Add($offer);
				$this->showAddImageView($id); 
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
				$jo_id = $this->jobOfferDAO->last();
				$jo = new JobOffer();
				$jo = $this->jobOfferDAO->searchOfferById($jo_id);
				$file = $_FILES['o_image'];
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

			$isPostuled = $studentXJobOfferDAO->isPostuled($_SESSION['id_student'], $idJob);

			if($isPostuled != true) {
				$studentXJobOffer->setStudentId($_SESSION['id_student']);
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
				$student_repository = new StudentDAO();
				$student_list = $student_repository->getAll();
				 
				//Job Position para printear nombre posicion
				$jobPosition_repository = new JobPositionDAO();
				$jobPosition_list = $jobPosition_repository->getAll();
 
				//SxJO para buscar ID estudiante vinculado a una oferta
				$student_x_offer = new StudentXJobOfferDAO();
				$student_x_offer_list = $student_x_offer->getAll();

				//Career para mostrar carrera del estudiante.
				$career_repository = new CareerDAO();
				$career_list = $career_repository->getAll();
 
				//Career para guardar el nombre
				$career_aux = new Career();
 
				//JO para buscar la oferta con la ID que nos enviaron
				$jo = $this->jobOfferDAO->searchOfferById($id);
				require_once(VIEWS_PATH. "/joboffer/students-postulated.php");
			 } else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			 }
		}

		//? Listado estudiantes PDF

		public function PDFStudents($offerId)
		{
			if($_SESSION) {
				$offer = $this->jobOfferDAO->searchOfferById($offerId);
				$companyDAO = new CompanyDAO();
				$company = $companyDAO->getById($offer->getIdCompany());
				$offerName = $offer->getDescription();
				$companyName = $company->getComp_name();
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

				$student = $studentDAO->searchStudentById($studentId);
				$JO = $this->jobOfferDAO->SearchOfferById($jobOfferId);
				$company = $companyDAO->getById($JO->getIdCompany());

				$sxjDAO->remove($studentId, $jobOfferId);
				$msg = 'Tu postulacion hacia la oferta [' . $JO->getDescription(). '] de la empresa ['. $company->getComp_name() .'] fue declinada por un administrador. Gracias por participar en nuestra busqueda!</b>';

				$email = $student->getEmail();
				$mailrepository = new MailDAO();
				$mailrepository->sendNewMail($email,$msg);
				echo "<script>alert('Postulación declinada con exito');</script>";
            	$this->showListView();
			} else {
				$messageDAO = (new MessageDAO())->notLoggedMessage();
			 }
		}
		
        //! =================================================================================================
}
 ?>