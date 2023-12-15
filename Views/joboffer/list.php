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
                         foreach($jobPosition_list as $jobPosition)
                         {
                              foreach($jo_list as $job_offer){
                               if($job_offer->getIdCompany() == $comp->getComp_id() && $job_offer->getActive() == true){
                                if($job_offer->getIdJobPosition() == $jobPosition->getId())
                                {
                                   $jobPosition_aux = $jobPosition;
                                   $id_job_offer = $job_offer->getId();
                                   if($_SESSION['type'] == 0)
                                   {    
                         ?>
                              <th class="joboffer admin"  style="background-image: url('<?php echo $job_offer->getImage()?>')" ><p><?php echo $jobPosition_aux->getDescription(); ?></p><p><?php  echo $job_offer->getDescription()?></p><p><?php echo $comp->getComp_name()?></p><p><?php echo $job_offer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ApplyForJob/<?php echo $id_job_offer?>">Postularse</a></th>
                         </tr>
                         <?php
                         }
                              else if($_SESSION['type'] == 1)
                              {
                         ?>
                         <th class="joboffer admin"  style="background-image: url('<?php echo $job_offer->getImage()?>')" ><p><?php echo $jobPosition_aux->getDescription(); ?></p><p><?php  echo $job_offer->getDescription()?></p><p><?php echo $comp->getComp_name()?></p><p><?php echo $job_offer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showModifyView/<?php echo $id_job_offer?>">Modificar</a><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ShowStudents/<?php echo $id_job_offer?>">Ver Postulados</a></th>
                         <?php
                         }
                              else if($_SESSION['type'] == 2)
                              {
                         ?>
                         <th class="joboffer admin"  style="background-image: url('<?php echo $job_offer->getImage()?>')" ><p><?php echo $jobPosition_aux->getDescription(); ?></p><p><?php  echo $job_offer->getDescription()?></p><p><?php echo $comp->getComp_name()?></p><p><?php echo $job_offer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showModifyView/<?php echo $id_job_offer?>">Modificar</a><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ShowStudents/<?php echo $id_job_offer?>">Ver Postulados</a></th>
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
