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
                                        foreach($studentXJobOfferList as $studentXJobOffer)
                                        {
                                             if ($studentXJobOffer->getStudentId() == $student->getRecordId())
                                             {
                                                  foreach($jobOfferList as $jobOffer)
                                                  {
                                                       if( $studentXJobOffer->getJobOfferId() == $jobOffer->getId())
                                                       {
                                                       foreach($jobPositionList as $jobPosition)
                                                       {
                                                            if($jobOffer->getJobPositionId() == $jobPosition->getId())
                                                            {
                                                                 $jobPositionAux = $jobPosition;
                                                                 $idJobOffer = $jobOffer->getId();
                                                                      if($jobOffer->getActive() == true){
                                   ?>
                                   <th class="joboffer postulated " style="background-image: url('<?php echo $jobOffer->getImage()?>')" > <?php echo $jobOffer->getId()?><br> <?php $jobPositionAux->getDescription(); ?> <?php  echo $jobOffer->getDescription()?> <br> <?php echo $jobOffer->getDate()?></th>
                                   
                                   <?php
                                        }
                                        else
                                        {
                                   ?>
                                   <th class="joboffer expired" style="background-image: url('<?php echo $jobOffer->getImage()?>');" > 
                                   <div>
                                        <p><?php echo $jobOffer->getId()?></p>
                                        <p><?php $jobPositionAux->getDescription()?></p>
                                        <p><?php  echo $jobOffer->getDescription()?></p>
                                        <p><?php echo $jobOffer->getDate()?></p>
                                        <p style="color:red">EXPIRADA</p>
                                   </div>
                                   </th>
                                  
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
