<?php


	if(isset($_SESSION['type'])){
		switch($_SESSION['type']){

			case 0:
				require_once "nav-student.php";
				break;

			case 1:
				require_once "nav-admin.php";
				break;
			case 2:
				require_once "nav-company.php";
				break;

		}
	}

 ?>