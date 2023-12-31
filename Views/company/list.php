<?php namespace Views?>


<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>

<?php
require_once("Config/Autoload.php");
use Config\Autoload as Autoload;

Autoload::Start();

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use Controllers\CompanyController as CompanyController;


$comp_repository = new CompanyDAO();
$comp_list = $comp_repository->GetAll();



$cc = new CompanyController();


?>

<body>
    <div id="root vh90">
     <form action="" method="post"></form>
     <section class="container vh90">
          <div class="company-list-container">
               <form action="<?php echo FRONT_ROOT?>Company/searchCompany" method="post" >
               <input class="input" type="search" id="comp_name" name="comp_name" placeholder="Ingrese Empresa" required>
               <button class="btn-submit" type="submit">Buscar</button>
               </form>
               <table class="company-table">
                    <tbody class="company-table-body">
                         <tr class="companies">
                         <?php 
                              foreach($comp_list as $company){
                              if ($company->getComp_active() == true)
                              {
                                   $id=$company->getComp_id();
                         ?>
                             <th class="company"><?php echo $company->getComp_name()?><br><?php echo $company->getComp_type()?><a name ="comp_select" href="<?php echo FRONT_ROOT?>Company/ShowCompanyById/<?php echo $id?>">Ver Info Completa</a></th>
                         </tr>
                        
                         <?php
                         }}
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
     </div>
<body>

<?php include('./Views/footer.php'); ?>


