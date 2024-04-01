<?php namespace Views?>


<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
    <div id="root">
        <section class="container">
            <div class="add-company-container">
            <h1>Agrega una empresa</h1>
            <form class="add-company-form " action="<?php echo FRONT_ROOT ?>Company/add" method= "post">
               <input class="input" type="text" name="name" placeholder="Ingresar nombre" required>
               <input class="input" type="text" name="type" placeholder="Ingresar tipo" required>
               <input class="input" type="email" name="email" placeholder="Ingresar correo" required>
               <input class="input" type="password" name="password" placeholder="Ingresar contraseña" required>
               <button class="btn-submit" type="submit">Agregar</button>
             </form>
        </section>
    </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>