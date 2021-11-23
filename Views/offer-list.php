<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

<?php
require_once("Config/Autoload.php");
use Config\Autoload as Autoload;

Autoload::Start();

?>

<main>
     <form action="" method="post"></form>
     <section id="comp_list">
          
          <div id="comp_container">
             
               <table id="comp_table">
                    <tbody>
                         <tr>
                         <?php 
                         foreach($jobPosition_list as $jobPosition)
                         {
                              foreach($jo_list as $job_offer){
                               if($job_offer->getIdCompany() == $comp->getComp_id() && $job_offer->getActive() == true){
                                if($job_offer->getIdJobPosition() == $jobPosition->getId())
                                {
                                
                                    $jobPosition_aux = $jobPosition;
                                    $id_job_offer = $job_offer->getId();
                                    
                                    
                               
                            
                                 
                              
                         ?>
                            
                       
                             <th class="th_box"> <?php echo $job_offer->getId()?><br> <?php echo $jobPosition_aux->getDescription(); ?><br> <?php  echo $job_offer->getDescription()?> <br> <?php echo $job_offer->getFecha()?><a name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ApplyForJob/<?php echo $id_job_offer?>">Postularse</a></th>
                         </tr>
                        
                         <?php
                        }} }  }
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('footer.php'); ?>
