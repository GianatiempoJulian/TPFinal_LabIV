<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
          <section class="container vh90">
               <div class="modify-joboffer-container">
               <h1>Modificando <?php echo $jobOfferAux->getDescription() . " de la empresa " . $companyAux->getName()?></h1>
               <form class="modify-joboffer-form" action="<?php echo FRONT_ROOT ?>JobOffer/modify" method= "post">
                    <input class="input" type="text" name="id" style="display:none" value="<?php echo $jobOfferAux->getId()?>" readonly>
                    <input class="input" type="text" name="idCompany" style="display:none" value="<?php echo $companyAux->getId()?>" placeholder="<?php echo $companyAux->getName()?>" readonly>
                    <input class="input" type="text" name="idJobPosition" style="display:none" value="<?php echo $jobPositionAux->getId()?>" readonly>   
                    <input class="input" type="date" name="fecha" style="display:none" value="<?php echo $jobOfferAux->getDate()?>" readonly>
                    <input class="input" type="text" name="description" value="<?php echo $jobOfferAux->getDescription()?>">
                    <input style="display:none" type="text" name="image" value="<?php echo $jobOfferAux->getImage()?>">
                    <button class="btn-submit" type="submit">Modificar</button>
             </form>
          </div>
        </section>
     </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>