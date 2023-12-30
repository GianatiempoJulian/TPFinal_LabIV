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
 
?>

<body>
    <div id="root vh90">
    <section class="container vh90">
        <div class="user-profile-container">
            <div class="img-container">
                <img src="<?php echo IMG_PATH ?>/pp/admin.png" alt="profile_picture">
            </div>
             <div>
                <h2><?php echo $user->getFirstName() . " " .  $user->getLastName()?></h2>
                <h5>Administrador</h5>
             </div>
             <div class="user-profile-options">
               
             </div>
             <div>
             </div>
             <ul class="user-profile-data">
                <li><?php echo "Tipo: ".$user->getType_user() ?></li>
                <li><?php echo"Email: ". $user->getEmail() ?></li>
            </ul>
        </div>
    </section>
    </div>
</body>




<?php include('./Views/footer.php'); ?>