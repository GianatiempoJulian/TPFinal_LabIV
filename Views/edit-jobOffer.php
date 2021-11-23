<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Modificando <?php echo $jo_aux->getDescription() . " de la empresa " . $co->getComp_name()?></header>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method= "post">
            <div class="add-company_form">
                 
                    <input type="text" name="o_id" style="opacity:0" value="<?php echo $jo_aux->getId()?>" opacity: 0; readonly>
               </div>
               <div class="add-company_form">
                    
                    <input type="text" name="o_idCompany" style="opacity:0" value="<?php echo $comp_aux->getComp_id()?>" placeholder="<?php echo $comp_aux->getComp_name()?>" readonly>
               </div>
               <div class="add-company_form">
                    <input type="text" name="o_idJobPosition" style="opacity:0" value="<?php echo $jp_aux->getId()?>" readonly>   
               </div>
               <div class="add-company_form">
                    <input type="date" name="o_fecha" style="opacity:0" value="<?php echo $jo_aux->getFecha()?>" readonly>
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