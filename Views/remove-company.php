<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Dar de baja una empresa</header>
            <form action="<?php echo FRONT_ROOT ?>Company/Remove" method= "post">
               <div class="add-company_form">
                    <input type="number" name="comp_id" placeholder="Ingresar ID para dar de baja" required>
               </div>
               <button type="submit" class="submit_button">Enviar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>