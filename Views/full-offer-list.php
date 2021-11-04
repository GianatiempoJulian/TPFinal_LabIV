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
                                  foreach ($company_list as $comp){
                                    if ($job_offer->getActive() == true)
                                    {
                               if($job_offer->getIdCompany() == $comp->getComp_id()){
                                   $company_aux = $comp;
                                if($job_offer->getIdJobPosition() == $jobPosition->getId())
                                {
                                
                                    $jobPosition_aux = $jobPosition;
                                    $id_job_offer = $job_offer->getId();
                                    
                                    
                               
                            
                                 
                              
                         ?>
                            
                       
                             <th class="th_box"> <?php echo $job_offer->getId()?><br> <?php $jobPosition_aux->getDescription(); ?> <?php  echo $job_offer->getDescription()?> <br> <?php echo $company_aux->getComp_name()?> <br> <?php echo $job_offer->getFecha()?><a name ="comp_select" href="<?php echo FRONT_ROOT?>JobOffer/ApplyForJob/<?php echo $id_job_offer?>">Postularse</a></th>
                         </tr>
                        
                         <?php
                        }} }  }}}
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('footer.php'); ?>
