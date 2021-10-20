<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>


<?php


?>

<?php

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");
require_once("../Controllers/CompanyController.php");




/// NO ANDA EL AUTOLOAD ///




//require_once("../Config/Autoload.php");
//use Config\Autoload as Autoload;




use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use Controllers\CompanyController as CompanyController;


$comp_repository = new CompanyDAO();
$comp_list = $comp_repository->GetAll();



$cc = new CompanyController();


?>

<main>
     <form action="" method="post"></form>
     <section id="comp_list">
          
          <div id="comp_container">
               <form action="company-search.php" method="post" >
               <input type="search" id="comp_search" name="comp_search" class="search_bar" placeholder="Ingrese Empresa" required>
               <button type="submit" name="submit"  class="submit_button" id="submit_button_company_search">Buscar</button>
               </form>
               <table id="comp_table">
                    <tbody>
                         <tr>
                         <?php 
                              foreach($comp_list as $company){
                                   $x=$company->getComp_id();
                                 
                         ?>
                            
                             <th class="th_box"><?php echo $company->getComp_name()?> <br> <?php echo $company->getComp_type()?><a name ="comp_select" <?php echo "<a href='company_profile.php?comp_id=$x'>Ver info. completa</a>"?></a></th>
                         </tr>
                        
                         <?php
                         }
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('footer.php'); ?>


