<?php namespace Views; ?>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<?php 

require_once("Config/Autoload.php");


   use Config\Autoload as Autoload;
   use DAO\CompanyDAO as CompanyDAO;
   use Models\Company as Company;

   use DAO\CareerDAO as CareerDAO;
   use DAO\ICareerDAO as ICareerDAO;
   use Models\Career as Career;

   Autoload::Start();

//if(session_start()) {


 foreach($compList as $comp)
 {

   if($comp->getComp_email() == $comp_mail)
   {
    
?>
<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="<?php echo IMG_PATH ?>diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php  echo $comp->getComp_name()?></h1>
        </div>
        <ul>
          
            <li><?php echo "Tipo: ".$comp->getComp_type() ?></li>
            <li><?php echo"Email: ". $comp->getComp_email() ?></li>
         
        </ul>
    </section>
</article>
<?php
    }
   }

?>

<?php include('footer.php'); ?>