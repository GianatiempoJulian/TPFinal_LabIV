<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
     <div id="root vh90">
        <section class="container vh90">
            <div class="modify-company-container">
            <h1>Modificando <?php echo $companyAux->getComp_name()?></h1>
            <form class="modify-company-form" action="<?php echo FRONT_ROOT ?>Company/Modify" method= "post">
               <input class="input" type="text" name="comp_id" value="<?php echo $companyAux->getComp_id()?>" readonly style="display:none">
               <input class="input" type="text" name="comp_name" value="<?php echo $companyAux->getComp_name()?>">
               <input class="input" type="text" name="comp_type" value="<?php echo $companyAux->getComp_type()?>">
               <button class="btn-submit" type="submit">Modificar</button>
             </form>
            </div>
        </section>
</div>
</body>

<?php include('./Views/footer.php'); ?>