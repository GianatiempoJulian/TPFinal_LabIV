<?php namespace Views?>


<?php include('./Views/header.php'); ?>
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
                    <div class="joboffer-list-container">
                         <table class="joboffer-table">
                              <tbody class="joboffer-table-body">
                                   <tr class="joboffers">
                                   <?php
                                        foreach($student_x_offer_list as $sxj)
                                        {
                                             if ($sxj->getStudentId() == $student->getStudentId())
                                             {
                                                  foreach($jo_list as $job_offer)
                                                  {
                                                       if( $sxj->getJobOfferId() == $job_offer->getId())
                                                       {
                                                       foreach($jobPosition_list as $jobPosition)
                                                       {
                                                            if($job_offer->getIdJobPosition() == $jobPosition->getId())
                                                            {
                                                                 $jobPosition_aux = $jobPosition;
                                                                 $id_job_offer = $job_offer->getId();
                                                                      if($job_offer->getActive() == true){
                                   ?>
                                   <th class="joboffer postulated " style="background-image: url('<?php echo $job_offer->getImage()?>')" > <?php echo $job_offer->getId()?><br> <?php $jobPosition_aux->getDescription(); ?> <?php  echo $job_offer->getDescription()?> <br> <?php echo $job_offer->getFecha()?></th>
                                   
                                   <?php
                                        }
                                        else
                                        {
                                   ?>
                                   <th class="joboffer expired" style="background-image: url('<?php echo $job_offer->getImage()?>')" > <?php echo $job_offer->getId()?><br> <?php $jobPosition_aux->getDescription(); ?> <?php  echo $job_offer->getDescription()?> <br> <?php echo $job_offer->getFecha()?> <br> Expirada</th>
                                  
                              <?php
                              }
                              ?>
                               </tr>
                               <?php
                              }
                              }
                              }
                              }
                              }
                              }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</body>

<?php include('./Views/footer.php'); ?>
