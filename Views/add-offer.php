<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

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
    <article id="add-company_article">
        <section id="add-company_secton">

            <header id="front_text">Agrega una oferta laboral</header>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method= "post">
            <div class="add-company_form">
                    <input type="text" name="o_id" placeholder="Ingresar ID Job Offer" required>
               </div>
            <div class="add-company_form">
               <label for="">Job Position</label>
               <select name="id_jp" id="id_jp">
                    <?php  foreach($jobPositionList as $jobPosition){
                                                  ?>
               <option value=<?php echo $jobPosition->getId() ?>><?php echo $jobPosition->getDescription() ?></option> 
                    <?php } ?>

               </select>
             </div>
             <div class="add-company_form">
               <label for="">Empresas</label>
               <select name="id_com" id="id_com">
                    <?php  foreach($companyList as $company){
                                                  ?>
               <option value=<?php echo $company->getComp_Id() ?>><?php echo $company->getComp_name() ?></option> 
                    <?php } ?>

               </select>
             </div>
               <div class="add-company_form">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" placeholder="Ingresar Fecha" required>
               </div>
               <div class="add-company_form">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" placeholder="Ingresar descripción" required>
               </div>
               <button type="submit" class="submit_button">Agregar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); 

?>


                                  
