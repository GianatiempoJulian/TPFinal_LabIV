<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Agrega una oferta laboral</header>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method= "post">
            <div class="add-company_form">
                    <input type="text" name="o_id" placeholder="Ingresar ID Job Offer" required>
               </div>
               <div class="add-company_form">
                    <input type="text" name="id_jp" placeholder="Ingresar ID Job Position" required>
               </div>
               <div class="add-company_form">
                    <input type="text" name="id_com" placeholder="Ingresar ID de Empresa" required>
               </div>
               <div class="add-company_form">
                    <input type="date" name="fecha" placeholder="Ingresar Fecha" required>
               </div>
               <div class="add-company_form">
                    <input type="text" name="description" placeholder="Ingresar descripción" required>
               </div>
               <button type="submit" class="submit_button">Agregar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>