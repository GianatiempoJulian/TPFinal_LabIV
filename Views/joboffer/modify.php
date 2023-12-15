<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
          <section class="container vh90">
               <div class="modify-joboffer-container">
               <h1>Modificando <?php echo $jo_aux->getDescription() . " de la empresa " . $comp_aux->getComp_name()?></h1>
               <form class="modify-joboffer-form" action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method= "post">
                    <input class="input" type="text" name="o_id" style="display:none" value="<?php echo $jo_aux->getId()?>" readonly>
                    <input class="input" type="text" name="o_idCompany" style="display:none" value="<?php echo $comp_aux->getComp_id()?>" placeholder="<?php echo $comp_aux->getComp_name()?>" readonly>
                    <input class="input" type="text" name="o_idJobPosition" style="display:none" value="<?php echo $jp_aux->getId()?>" readonly>   
                    <input class="input" type="date" name="o_fecha" style="display:none" value="<?php echo $jo_aux->getFecha()?>" readonly>
                    <input class="input" type="text" name="o_description" value="<?php echo $jo_aux->getDescription()?>">
                    <input style="display:none" type="text" name="o_image" value="<?php echo $jo_aux->getImage()?>">
                    <button class="btn-submit" type="submit">Modificar</button>
             </form>
          </div>
        </section>
     </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>