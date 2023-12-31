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
          <div class="joboffer-list-container">
               <table class="joboffer-table">
                    <tbody class="joboffer-table-body">
                         <tr class="joboffers">
                         <?php 
                         foreach($jobPositionList as $jobPosition)
                         {
                              foreach($jobOfferList as $jobOffer){
                               if($jobOffer->getIdCompany() == $company->getComp_id() && $jobOffer->getActive() == true){
                                if($jobOffer->getIdJobPosition() == $jobPosition->getId())
                                {
                                   $jobPositionAux = $jobPosition;
                                   $idJobOffer = $jobOffer->getId();
                                   if($_SESSION['type'] == 0)
                                   {    
                         ?>
                              <th class="joboffer admin"  style="background-image: url('<?php echo $jobOffer->getImage()?>')" ><p><?php echo $jobPositionAux->getDescription(); ?></p><p><?php  echo $jobOffer->getDescription()?></p><p><?php echo $company->getComp_name()?></p><p><?php echo $jobOffer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/applyForJob/<?php echo $idJobOffer?>">Postularse</a></th>
                         </tr>
                         <?php
                         }
                              else if($_SESSION['type'] == 1)
                              {
                         ?>
                         <th class="joboffer admin"  style="background-image: url('<?php echo $jobOffer->getImage()?>')" ><p><?php echo $jobPositionAux->getDescription(); ?></p><p><?php  echo $jobOffer->getDescription()?></p><p><?php echo $company->getComp_name()?></p><p><?php echo $jobOffer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showModifyView/<?php echo $idJobOffer?>">Modificar</a><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showStudents/<?php echo $idJobOffer?>">Ver Postulados</a></th>
                         <?php
                         }
                              else if($_SESSION['type'] == 2)
                              {
                         ?>
                         <th class="joboffer admin"  style="background-image: url('<?php echo $jobOffer->getImage()?>')" ><p><?php echo $jobPositionAux->getDescription(); ?></p><p><?php  echo $jobOffer->getDescription()?></p><p><?php echo $company->getComp_name()?></p><p><?php echo $jobOffer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showModifyView/<?php echo $idJobOffer?>">Modificar</a><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showStudents/<?php echo $idJobOffer?>">Ver Postulados</a></th>
                         <?php
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
    </div>
</body>

<?php include('./Views/footer.php'); ?>
