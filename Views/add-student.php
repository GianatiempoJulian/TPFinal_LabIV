<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Agrega un alumno</header>
            <form action="<?php echo FRONT_ROOT ?>Student/Add" method= "post">
               <div class="add-company_form">
                    <input type="email" name="email" placeholder="Ingresar email" required>
               </div>
               <button type="submit" class="submit_button">Verificar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>