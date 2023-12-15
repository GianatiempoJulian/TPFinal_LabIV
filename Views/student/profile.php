<?php namespace Views; ?>
<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>

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



    
?>
<body>
    <div id="root vh90">
    <section class="container vh90">
        <div class="user-profile-container">
            <div class="img-container">
             <img src="<?php echo IMG_PATH ?>/pp/student.png" alt="profile_picture">
            </div>
             <div>
                <h2><?php echo $student->getFirstName() . " " .  $student->getLastName()?></h2>
                <h5><?php echo $career_from_student->getCarrer_description() ?></h5>
             </div>
             <div class="user-profile-options">
                <a href="<?php echo FRONT_ROOT?>Student/ShowOfferStudent/<?php echo $student->getStudentId()?>">Empleos Solicitados</a>
             </div>
             <div>
             </div>
             <ul class="user-profile-data">
                <li><?php echo "ID: ". $student->getStudentId() ?></li>
                <li><?php echo "Tipo: ".$student->getType_user() ?></li>
                <li><?php echo "DNI: ".$student->getDni() ?></li>
                <li><?php echo "File Number:".$student->getFileNumber() ?></li>
                <li><?php echo"Genero: ". $student->getGender() ?></li>
                <li><?php echo "Fecha Nacimiento: ".$student->getBirthDate() ?></li>
                <li><?php echo "Telefono: ".$student->getPhoneNumber() ?></li>
                <li><?php echo"Email: ". $student->getEmail() ?></li>
            </ul>
        </div>
    </section>
    </div>
</body>
<?php
 
?>

<?php include('./Views/footer.php'); ?>