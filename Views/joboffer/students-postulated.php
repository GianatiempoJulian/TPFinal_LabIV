<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>

<?php
require_once("Config/Autoload.php");
use Config\Autoload as Autoload;

Autoload::Start();

?>

<body>
     <div id="root vh90">     
          <form action="" method="post"></form>
               <section class="container vh90">
                    <div class="user-list-container">
                         <table class="user-table">
                              <tbody class="user-table-body">
                                   <tr class="users">
                                   <?php
                                   foreach($student_x_offer_list as $sxj)
                                   {
                                        if ($sxj->getJobOfferId() == $jo->getId())
                                        {
                                             $id_job_offer = $sxj->getJobOfferId();
                                             foreach($student_list as $student)
                                             {
                                                  if( $sxj->getStudentId() == $student->getStudentId() && $jo->getActive() == true)
                                                  {
                                                       foreach($career_list as $career)
                                                       {
                                                            if($career->getCareerId() == $student->getCareerId())
                                                            {
                                                                 $career_aux = $career;
                                   ?>
                                   <th class="user"><?php echo $student->getStudentId()?><br> <?php echo $student->getFirstName() . " " . $student->getLastName()?> <br> <?php echo $career_aux->getCarrer_description()?>  <br> <?php echo $student->getDni()?> <br> <?php echo $student->getEmail()?> <br> <?php echo $jo->getFecha()?><a href="<?php echo FRONT_ROOT?>JobOffer/denyApplyByAdmin/<?php echo $student->getStudentId()?>/<?php echo $id_job_offer?>">Declinar Postulacion</a></th>
                                   </tr>
                              <?php
                              }
                              }
                              }
                              }
                              }
                              }
                              ?>
                              <a class="pdf-btn" href="<?php echo FRONT_ROOT?>JobOffer/PDFStudents/<?php echo $id_job_offer?>">PDF</a>
                         </tbody>
                    </table>
               </div>
          </section>
     </div>
</body>

<?php include('./Views/footer.php'); ?>