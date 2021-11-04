<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Dar de alta una oferta laboral</header>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Alta" method= "post">
               <div class="add-company_form">
                    <input type="number" name="job_offer_id" placeholder="Ingresar ID para dar de alta" required>
               </div>
               <button type="submit" class="submit_button">Enviar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>