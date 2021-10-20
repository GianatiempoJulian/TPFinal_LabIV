<?php

namespace Views;
  

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");
require_once("../Controllers/CompanyController.php");

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use Controllers\CompanyController as CompanyController;

    $comp_dao = new CompanyDAO();
    //$comp_list = $comp_dao->getAll();

    if($_POST){

    
        $id = $_POST["comp_id"];
        $new_value = $_POST["new_value"];
        $option = $_POST["option"];


            switch($option)
           {
               case 1:
                 $comp_dao->ModifyName($id,$new_value);
                 break;
            
                case 2:
                $comp_dao->ModifyType($id,$new_value);
                break;
           }

               
              
       
        header ("location: edit-company.php?msg=editada");
       
        
    }

?>

?>