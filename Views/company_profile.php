<?php include('header.php'); ?>
<?php include('nav.php'); ?>


<?php

require_once("../DAO/CompanyDAO.php");
require_once("../Models/Company.php");
require_once("../DAO/ICompanyDAO.php");

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;


if($_GET){

    $e = $_GET['comp_id'];
    
    
    $comp_repository = new CompanyDAO();
    $comp_list = $comp_repository->GetAll();

    
    foreach($comp_list as $company){
        if ($company->getComp_id() == $e)
        {
            $comp_aux = $company;
        }
    }



}


?>

<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="img/diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php echo $comp_aux->getComp_name(); ?></h1>
             <h5 id="profile_type"><?php echo $comp_aux->getComp_type(); ?></h5>
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