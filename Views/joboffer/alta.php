<?php namespace Views?>
<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
          <form action="<?php echo FRONT_ROOT ?>JobOffer/alta" method= "post">
          <section class="container vh90">
               <div class="altabaja-joboffer-container">
               <table class="joboffer-table">
                    <h1>Dar de alta una oferta laboral</h1>
                    <input class="input input-altabaja" type="number" name="job_offer_id" placeholder="Ingresar ID para dar de alta" required>
                    <tbody class="joboffer-table-body">
                         <tr class="joboffers">
                         <?php 
                             foreach($jo_list as $jo){
                              foreach($companies as $c){
                                   if ($jo->getIdCompany() == $c->getComp_id()){
                        ?>
                             <th class="joboffer joboffer-altabaja"><?php echo $jo->getId()?><br><?php echo $jo->getDescription()?><br><?php echo $c->getComp_name()?><br><a href="<?php echo FRONT_ROOT ?>JobOffer/alta/<?php echo $jo->getId()?>">Alta</a></th>
                         </tr>
                         <?php
                         }}}
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
