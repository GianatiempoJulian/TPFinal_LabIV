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
                         foreach($student_x_offer_list as $sxj)
                         {
                              if ($sxj->getStudentId() == $student->getStudentId())
                              {
                                  
                                   foreach($jo_list as $job_offer)
                                   {
                                        if( $sxj->getJobOfferId() == $job_offer->getId())
                                        {
                                        foreach($jobPosition_list as $jobPosition){
                                   
                                             if($job_offer->getIdJobPosition() == $jobPosition->getId())
                                             {
                                        
                                                  $jobPosition_aux = $jobPosition;
                                                  $id_job_offer = $job_offer->getId();

                                           
                              
                         ?>
                            
                       
                                                <th class="th_box"> <?php echo $job_offer->getId()?><br> <?php $jobPosition_aux->getDescription(); ?> <?php  echo $job_offer->getDescription()?> <br> <?php echo $job_offer->getFecha()?></th>
                         </tr>
                        
                         <?php
                         }}}}}}
                         ?>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php include('footer.php'); ?>