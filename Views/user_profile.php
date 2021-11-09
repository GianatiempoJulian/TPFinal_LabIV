<?php namespace Views; ?>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<?php 

require_once("Config/Autoload.php");


   use Config\Autoload as Autoload;
   use DAO\StudentDAO as StudentDAO;
   use DAO\IStudentDAO as IStudentDAO;
   use Models\Student as Student;

   use DAO\CareerDAO as CareerDAO;
   use DAO\ICareerDAO as ICareerDAO;
   use Models\Career as Career;

   Autoload::Start();

//if(session_start()) {


 foreach($userList as $user)
 {

   if($user->getEmail() == $user_mail)
   {
    
?>
<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="<?php echo IMG_PATH ?>diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php  echo $user->getFirstName() . " " .  $user->getLastName()?></h1>
        </div>
        <ul>
          
            <li><?php echo "Tipo: ".$user->getType_user() ?></li>
            <li><?php echo"Email: ". $user->getEmail() ?></li>
         
        </ul>
    </section>
</article>
<?php
    }
   }

?>

<?php include('footer.php'); ?>