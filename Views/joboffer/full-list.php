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
                              foreach ($jobPositionList as $jobPosition)
                              {
                                   foreach ($joList as $jobOffer)
                                   {
                                        foreach ($companyList as $comp)
                                        {
                                             if ($jobOffer->getIdCompany() == $comp->getComp_id() && $jobOffer->getActive() == true)
                                             {
                                                  $companyAux = $comp;
                                                  if ($jobOffer->getIdJobPosition() == $jobPosition->getId())
                                                  {         
                                                       $jobPositionAux = $jobPosition;
                                                       $idJobOffer = $jobOffer->getId();    
                                                       if ($_SESSION['type'] == 0)
                                                       {
                                                            if($jobPosition->getCarrerId() == $studentAux->getCareerId())
                                                            {
                         ?>                                 
                                                                 <th class="joboffer admin"  style="background-image: url('<?php echo $jobOffer->getImage()?>')" ><p><?php echo $jobPositionAux->getDescription(); ?></p><p><?php  echo $jobOffer->getDescription()?></p><p><?php echo $companyAux->getComp_name()?></p><p><?php echo $jobOffer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ApplyForJob/<?php echo $idJobOffer?>">Postularse</a></th>
                              </tr>
                         <?php
                                                            }
                                                       } 
                                                       else if ($_SESSION['type'] == 1)
                                                       {
                                                  
                         ?>        
                                                  <th class="joboffer admin"  style="background-image: url('<?php echo $jobOffer->getImage()?>')" ><p><?php echo $jobPositionAux->getDescription(); ?></p><p><?php  echo $jobOffer->getDescription()?></p><p><?php echo $companyAux->getComp_name()?></p><p><?php echo $jobOffer->getFecha()?></p><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/showModifyView/<?php echo $idJobOffer?>">Modificar</a><a class="jobList_btn" name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ShowStudents/<?php echo $idJobOffer?>">Ver Postulados</a></th>
                         <?php
                                                  }}}}}}
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
    </div>
</body>

<?php include('./Views/footer.php'); ?>
