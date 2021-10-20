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
    $comp_list = $comp_dao->getAll();

    if($_POST){

    
        $id = $_POST["comp_id"];
    
    
        foreach ($comp_list as $company)
        {
            if($company->getComp_id() == $id)
            {
                $comp_dao->Remove($id);
            }
        }
       
        header ("location: remove-company.php?msg=eliminada");
       
        
    }

?>