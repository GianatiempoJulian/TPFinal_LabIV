<?php include('header.php'); ?>
<?php include('nav.php'); ?>


<?php


require_once("Config/Autoload.php");

use Config\Autoload as Autoload;
use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;


Autoload::Start();





?>

<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="img/diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php echo $comp->getComp_name(); ?></h1>
             <h5 id="profile_type"><?php echo $comp->getComp_type(); ?></h5>
        </div>
        <div id="profile_options">
            <a href="#">Editar Perfil</a>
            <a href="#">Empleos Disponibles</a>
            <a href="#">Favoritos</a>
        </div>
        
        <ul>
            <li></li>
            <li></li>
        </ul>
    </section>
</article>

<?php include('footer.php'); ?>