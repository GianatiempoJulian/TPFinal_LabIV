<?php 

	namespace DAO;

	class APIDAO
	{

		public static function retrieveCareers(){

				$opt = array(
					  "http" => array(
					  "method" => "GET",
					  "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
					)
				);
				
				$ctx = stream_context_create($opt);
				
				$json_career = file_get_contents("https://utn-students-api.herokuapp.com/api/Career", false, $ctx);
				
				$career_list = ($json_career) ? json_decode($json_career, true) : array();

				return $career_list;

		}


		public static function retrieveStudents()
		{

				$opt = array(
					  "http" => array(
					  "method" => "GET",
					  "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
					)
				);
				
				$ctx = stream_context_create($opt);
				
				$json_student = file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
				
				$student_list = ($json_student) ? json_decode($json_student, true) : array();

				return $student_list;

		}


		public static function retrieveJobPosition()
		{

				$opt = array(
					  "http" => array(
					  "method" => "GET",
					  "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
					)
				);
				
				$ctx = stream_context_create($opt);
				
				$json_job = file_get_contents("https://utn-students-api.herokuapp.com/api/JobPosition", false, $ctx);
				
				$job_list = ($json_job) ? json_decode($json_job, true) : array();

				return $job_list;

		}
	}

 ?>