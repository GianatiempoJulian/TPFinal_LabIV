<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<?php



?>

<?php 

   require_once ("../DAO/StudentDAO.php");
   require_once ("../DAO/IStudentDAO.php");
   require_once("../Models/Student.php");

   use DAO\StudentDAO as StudentDAO;
   use DAO\IStudentDAO as IStudentDAO;
   use Models\Student as Student;

if(session_start()) {


$mail = $_SESSION['user_mail'];

$studentList = new StudentDAO();
$api_students = $studentList->GetAll();


$studentInUse = new Student();

foreach($api_students as $student)
{
    if(strcmp($mail,$student->getEmail()) == 0)
        {
            $studentInUse = $student;
        }
}
  }

?>
<article>
    <section id="profile_section">
        <div id="profile_box">
             <img src="img/diabloamarllo.png" alt="profile_picture">
             <h1 id="profile_name"><?php  echo $studentInUse->getFirstName() . " " .  $studentInUse->getLastName()?></h1>
             <h5 id="profile_career"><?php echo $studentInUse->getCareerId() ?></h5>
        </div>
        <div id="profile_options">
            <a href="#">Editar Perfil</a>
            <a href="#">Empleos Solicitados</a>
            <a href="#">Favoritos</a>
        </div>
        
        <ul>
            <li><?php echo $studentInUse->getStudentId() ?></li>
            <li><?php echo $studentInUse->getDni() ?></li>
            <li><?php echo $studentInUse->getFileNumber() ?></li>
            <li><?php echo $studentInUse->getGender() ?></li>
            <li><?php echo $studentInUse->getBirthDate() ?></li>
            <li><?php echo $studentInUse->getEmail() ?></li>
            <li><?php echo $studentInUse->getPhoneNumber() ?></li>
            <li><?php echo $studentInUse->getActive() ?></li>
            <li></li>
        </ul>
    </section>
</article>

<?php include('footer.php'); ?>