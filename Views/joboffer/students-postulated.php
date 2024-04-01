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
                                   foreach($studentOfferList as $studentOffer)
                                   {
                                        if ($studentOffer->getJobOfferId() == $jobOffer->getId())
                                        {
                                             $jobOfferId = $studentOffer->getJobOfferId();
                                             foreach($studentList as $student)
                                             {
                                                  if( $studentOffer->getStudentId() == $student->getRecordId() && $jobOffer->getActive() == true)
                                                  {
                                                       foreach($careerList as $career)
                                                       {
                                                            if($career->getId() == $student->getCareerId())
                                                            {
                                                                 $careerAux = $career;
                                   ?>
                                   <th class="user"><?php echo $student->getRecordId()?><br> <?php echo $student->getFirstname() . " " . $student->getLastname()?> <br> <?php echo $careerAux->getDescription()?>  <br> <?php echo $student->getDni()?> <br> <?php echo $student->getEmail()?> <br> <?php echo $jobOffer->getDate()?><a href="<?php echo FRONT_ROOT?>JobOffer/denyApplyByAdmin/<?php echo $student->getRecordId()?>/<?php echo $jobOfferId?>">Declinar Postulacion</a></th>
                                   </tr>
                              <?php
                              }
                              }
                              }
                              }
                              }
                              }
                              ?>
                              <a class="pdf-btn" href="<?php echo FRONT_ROOT?>JobOffer/PDFStudents/<?php echo $jobOfferId?>">PDF</a>
                         </tbody>
                    </table>
               </div>
          </section>
     </div>
</body>

<?php include('./Views/footer.php'); ?>