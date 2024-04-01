<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>


<?php


require_once("Config/Autoload.php");

use Config\Autoload as Autoload;
use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;


Autoload::Start();
?>

<body>
    <div id="root vh90">
    <section class="container vh90">
        <div class="company-profile-container">
            <div class="img-container">
                <img src="<?php echo IMG_PATH ?>/pp/company.png" alt="profile_picture">
            </div>
            <div>
                <h2><?php echo $company->getName(); ?></h2>
                <h5><?php echo $company->getType(); ?></h5>
             </div>
            <div class="company-profile-options">
                <?php 
                if ($_SESSION['type'] != 0)
                {?>
                    <a href="<?php echo FRONT_ROOT?>Company/showModifyView/<?php echo $company->getId()?>">Editar Empresa</a>
                    <?php
                }
                ?>
                <a href="<?php echo FRONT_ROOT?>Company/showOffers/<?php echo $company->getId()?>">Empleos Publicados</a>
                <?php
                
                if ($_SESSION['type'] == 1){
                ?>
                <a class="company-baja" href="<?php echo FRONT_ROOT?>Company/remove/<?php echo $company->getId()?>">Dar de baja Empresa</a>
                <?php
                }
                ?>
        </div>
    </section>
</article>

<?php include('./Views/footer.php'); ?>