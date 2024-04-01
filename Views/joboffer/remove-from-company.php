<?php namespace Views?>
<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
          <form action="<?php echo FRONT_ROOT ?>JobOffer/remove" method= "post">
          <section class="container vh90">
               <div class="remove-joboffer-container">
               <table class="joboffer-table">
                    <h1>Eliminar oferta laboral</h1>
                    <input class="input input-remove" type="number" name="job_offer_id" placeholder="Ingresar ID para dar de baja" required>
                    <tbody class="joboffer-table-body">
                         <tr class="joboffers">
                         <?php 
                             foreach($jobOfferList as $jobOffer){
                                   if ($jobOffer->getCompanyId() == $c->getId() && $jobOffer->getActive() == true){
                        ?>
                             <th class="joboffer joboffer-remove" style="background-image: url('<?php echo $jobOffer->getImage()?>')"><?php echo $jobOffer->getId()?><br><?php echo $jobOffer->getDescription()?><br> <a style="color:red" href="<?php echo FRONT_ROOT ?>JobOffer/remove/<?php echo $jobOffer->getId()?>">Eliminar</a></th>
                         </tr>
                         <?php
                         }}
                         ?>
                    </tbody>
               </table>
               <button class="btn-submit" type="submit">Enviar</button>
             </form>
        </section>
     </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>
