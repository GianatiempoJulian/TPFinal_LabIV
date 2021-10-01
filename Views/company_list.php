<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>


<?php

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");




/// NO ANDA EL AUTOLOAD ///




//require_once("../Config/Autoload.php");
//use Config\Autoload as Autoload;




use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;


$comp_repository = new CompanyDAO();
$comp_list = $comp_repository->GetAll();




?>

<main>
     <section id="comp_list">
          <div>
               
               <input type="search" id="comp_search" name="comp_search" class="search_bar" placeholder="Buscar empresa">
               <table id="comp_table">
                    <tbody>
                         <tr>
                         <?php 
                              foreach($comp_list as $company){
                         ?>
                              
                              <th class="th_box"><a href="company_profile.php"><?php echo $company->getComp_name()?> <br> <?php echo $company->getComp_type()?></a></th>
                             
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
