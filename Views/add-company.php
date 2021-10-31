<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Agrega una empresa</header>
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method= "post">
               <div class="add-company_form">
                    <input type="text" name="comp_name" placeholder="Ingresar nombre" required>
               </div>
               <div class="add-company_form">
                    <input type="text" name="comp_type" placeholder="Ingresar tipo" required>
               </div>
               <button type="submit" class="submit_button">Agregar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>