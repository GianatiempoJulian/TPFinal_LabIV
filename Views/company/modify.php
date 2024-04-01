<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
        <section class="container vh90">
            <div class="modify-company-container">
            <h1>Modificando <?php echo $companyAux->getName()?></h1>
            <form class="modify-company-form" action="<?php echo FRONT_ROOT ?>Company/modify" method= "post">
               <input class="input" type="text" name="id" value="<?php echo $companyAux->getId()?>" readonly style="display:none">
               <input class="input" type="text" name="name" value="<?php echo $companyAux->getName()?>">
               <input class="input" type="text" name="type" value="<?php echo $companyAux->getType()?>">
               <button class="btn-submit" type="submit">Modificar</button>
             </form>
            </div>
        </section>
</div>
</body>

<?php include('./Views/footer.php'); ?>