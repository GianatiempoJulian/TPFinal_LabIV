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
            <h1>Agrega una imagen a la oferta</h1>
            <form method="POST" enctype="multipart/form-data" class="add-joboffer-form" action="<?php echo FRONT_ROOT ?>JobOffer/AddImage">
                    <!--<input style="display:none" name="o_id" id="o_id" value="<?php //echo $id ?>">-->
                    <input class="input" name="o_image" id="o_image" type="file">
                    <button class="btn-submit" type="submit">Agregar</button>
            </form>
            </div>
        </section>
    </div>
</body>
</html>

<?php include('./Views/footer.php'); 

?>
