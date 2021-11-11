<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Modificando <?php echo $comp_aux->getComp_name()?></header>
            <form action="<?php echo FRONT_ROOT ?>Company/Modify" method= "post">
            <div class="add-company_form">
                    <label for="">ID</label>
                    <input type="text" name="comp_id" value="<?php echo $comp_aux->getComp_id()?>" readonly>
               </div>
               <div class="add-company_form">
                    <label for="">Nombre</label>
                    <input type="text" name="comp_name" value="<?php echo $comp_aux->getComp_name()?>">
               </div>
               <div class="add-company_form">
                    <label for="">Tipo</label>
                    <input type="text" name="comp_type" value="<?php echo $comp_aux->getComp_type()?>">
               </div>
               <button type="submit" class="submit_button">Modificar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>