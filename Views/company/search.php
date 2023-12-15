<?php namespace Views; ?>

<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>

<?php

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");


use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;


$comp_repository = new CompanyDAO();
$comp_list = $comp_repository->GetAll();

$texto =$_POST['comp_search']; 
 ?>

<main>
     <section>
          <div>
               <table>
                    <tbody>
                         <tr>
                         <?php 
                              foreach($comp_list as  $company){
                                   $x=$company->getComp_id();
                                  if(strcmp($company->getComp_name(),$texto) == 0) { 
                                    ?>
                                    <th><?php echo $company->getComp_name()?> <br> <?php echo $company->getComp_type()?><a name ="comp_select" <?php echo "<a href='company_profile.php?comp_id=$x'>Ver info. completa</a>"?></a></th>
                               <?php
                                }
                        
                              ?>
                              
                             
                         </tr>
                         <?php
                              }
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('./Views/footer.php'); ?>
