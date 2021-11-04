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


 foreach($studentList as $student)
 {

   if($student->getEmail() == $_SESSION['email'])
   {
    foreach($api_career as $career)
    {
        if($student->getCareerId() == $career->getCareerId())
            {
            
                $career_from_student = $career;
            }
    }
?>
<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="<?php echo IMG_PATH ?>diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php  echo $student->getFirstName() . " " .  $student->getLastName()?></h1>
             <h5 id="profile_career"><?php echo $career_from_student->getCarrer_description() ?></h5>
        </div>
        <div id="profile_options">
            <a href="#">Editar Perfil</a>
            <a href="<?php echo FRONT_ROOT?>Student/ShowOfferStudent/<?php echo $id?>">Empleos Solicitados</a>
            <a href="#">Favoritos</a>
        </div>
        
        <ul>
            <li><?php echo "ID: ". $student->getStudentId() ?></li>
            <li><?php echo "Tipo: ".$student->getType_user() ?></li>
            <li><?php echo "DNI: ".$student->getDni() ?></li>
            <li><?php echo "File Number:".$student->getFileNumber() ?></li>
            <li><?php echo"Genero: ". $student->getGender() ?></li>
            <li><?php echo "Fecha Nacimiento: ".$student->getBirthDate() ?></li>
            <li><?php echo"Email: ". $student->getEmail() ?></li>
            <li><?php echo "Telefono: ".$student->getPhoneNumber() ?></li>
            <li><?php echo "Estado: ".$student->getActive() ?></li>
        </ul>
    </section>
</article>
<?php
    }
   }

?>

<?php include('footer.php'); ?>