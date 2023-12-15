<?php namespace Views?>

<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>

<?php
require_once("Config/Autoload.php");
use Config\Autoload as Autoload;



use \DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;


$jobPosition = new JobPositionDAO();
$jobPositionList = $jobPosition->GetAll();

$company = new CompanyDAO();
$companyList = $company->GetAll();

Autoload::Start();
?>

<body>
    <div id="root">
        <section class="container vh90">
            <div class="add-user-container vh90">
            <h1>Agrega una oferta</h1>
            <form method="POST" class="add-joboffer-form" action="<?php echo FRONT_ROOT ?>JobOffer/Add" >
               <select class="input"  name="id_jp" id="id_jp">
                    <?php  foreach($jobPositionList as $jobPosition){
                    ?>
               <option value=<?php echo $jobPosition->getId() ?>><?php echo $jobPosition->getDescription() ?></option> 
                    <?php } ?>
               </select>
             <?php 
             if($_SESSION['type'] != 2)
             {
               ?>
               <div>
               <select class="input" name="id_com" id="id_com">
                    <?php  foreach($companyList as $company){
                    ?>
                         <option value=<?php echo $company->getComp_Id() ?>><?php echo $company->getComp_name() ?></option> 
                    <?php 
                    } 
                    ?>
               </select>
             </div>
            <?php 
             } 
             else
             {
               ?>
                    <input style="display:none" name="id_com" id="id_com" readonly value=<?php echo $_SESSION['id_comp']?>>
               <?php
             }
             ?>
               
                    <input class="input" type="date" name="fecha" placeholder="Ingresar Fecha" required>
                    <input class="input" type="text" name="description" placeholder="Ingresar descripción" required>
                    <button class="btn-submit" type="submit"">Siguiente</button>
             </form>
            </div>
        </section>
    </div>
</body>
</html>

<?php include('./Views/footer.php'); 

?>


                                  
