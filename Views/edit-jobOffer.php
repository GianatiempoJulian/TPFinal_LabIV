<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Modificando <?php echo $jo_aux->getDescription() . " de la empresa " . $co->getComp_name()?></header>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method= "post">
            <div class="add-company_form">
                    <label for="">ID</label>
                    <input type="text" name="o_id" value="<?php echo $jo_aux->getId()?>" readonly>
               </div>
               <div class="add-company_form">
                    <label for="">ID Empresa</label>
                    <input type="text" name="o_idCompany" value="<?php echo $jo_aux->getIdCompany()?>" readonly>
               </div>
               <div class="add-company_form">
                    <label for="">ID Job Position</label>
                    <input type="text" name="o_idJobPosition" value="<?php echo $jo_aux->getIdJobPosition()?>" readonly>
               </div>
               <div class="add-company_form">
                    <label for="">Fecha</label>
                    <input type="text" name="o_fecha" value="<?php echo $jo_aux->getFecha()?>" readonly>
               </div>
               <div class="add-company_form">
                    <label for="">Descripcion</label>
                    <input type="text" name="o_description" value="<?php echo $jo_aux->getDescription()?>">
               </div>
               <button type="submit" class="submit_button">Modificar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>