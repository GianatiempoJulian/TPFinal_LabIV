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
               <div class="add-company_form">
                    <input type="email" name="comp_email" placeholder="Ingresar correo" required>
               </div>
               <div class="add-company_form">
                    <input type="password" name="comp_pass" placeholder="Ingresar contraseña" required>
               </div>
               <button type="submit" class="submit_button">Agregar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>