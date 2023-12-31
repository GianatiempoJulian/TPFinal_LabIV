<?php namespace Views?>


<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>

<?php
require_once("Config/Autoload.php");
use Config\Autoload as Autoload;

Autoload::Start();

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use DAO\IStudentDAO as IStudentDAO;



$student_repository = new StudentDAO();
$stun_list = $student_repository->GetAll();





?>

<main>
     <form action="" method="post"></form>
     <section>
          <div>
               <form action="company-search.php" method="post">
               <input type="search" id="comp_search" name="comp_search" placeholder="Ingrese Alumno" required>
               <button type="submit" name="submit" id="submit_button_company_search">Buscar</button>
               </form>
               <table>
                    <tbody>
                         <tr>
                         <?php 
                              foreach($stun_list as $student){   
                         ?>
                            
                              
                             <th> <?php echo $student->getStudentId()?><br> <?php  echo $student->getFirstName()?> <br> <?php echo $student->getLastName()?><a name ="comp_select"></a></th>
                         </tr>
                        
                         <?php
                         }
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('./Views/footer.php'); ?>

