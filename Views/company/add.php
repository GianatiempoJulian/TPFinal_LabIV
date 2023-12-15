<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
    <div id="root vh90">
        <section class="container vh90">
            <div class="add-company-container">
            <h1>Agrega una empresa</h1>
            <form class="add-company-form " action="<?php echo FRONT_ROOT ?>Company/Add" method= "post">
               <input class="input" type="text" name="comp_name" placeholder="Ingresar nombre" required>
               <input class="input" type="text" name="comp_type" placeholder="Ingresar tipo" required>
               <input class="input" type="email" name="comp_email" placeholder="Ingresar correo" required>
               <input class="input" type="password" name="comp_pass" placeholder="Ingresar contraseña" required>
               <button class="btn-submit" type="submit">Agregar</button>
             </form>
        </section>
    </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>