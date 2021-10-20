<?php
namespace Views;
    ///procesa los datos y los pone en el JSON.

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");
require_once("../Controllers/CompanyController.php");

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use Controllers\CompanyController as CompanyController;

    $comp_dao = new CompanyDAO();
    $comp_list = $comp_dao->getAll();

    if($_POST){

    
        $id = $_POST["comp_id"];
        $name = $_POST["comp_name"];
        $type = $_POST["comp_type"];

    
        $comp_controller = new CompanyController();

        $comp_controller->Add($id,$name,$type);
        
       // header("location:add-company.php");
       // }
       
        
    }

   
    

?>