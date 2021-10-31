<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

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
     <section id="comp_list">
          
          <div id="comp_container">
               <form action="company-search.php" method="post" >
               <input type="search" id="comp_search" name="comp_search" class="search_bar" placeholder="Ingrese Alumno" required>
               <button type="submit" name="submit"  class="submit_button" id="submit_button_company_search">Buscar</button>
               </form>
               <table id="comp_table">
                    <tbody>
                         <tr>
                         <?php 
                              foreach($stun_list as $student){
                                  
                                 
                                 
                         ?>
                            
                              
                             <th class="th_box"> <?php echo $student->getStudentId()?><br> <?php  echo $student->getFirstName()?> <br> <?php echo $student->getLastName()?><a name ="comp_select"></a></th>
                         </tr>
                        
                         <?php
                         }
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('footer.php'); ?>
