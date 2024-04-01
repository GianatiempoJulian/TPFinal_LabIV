<?php namespace Views?>


<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>



<body>
    <div id="root">
        <section class="container">
            <div class="add-user-container">
            <h1>Agrega un alumno</h1>
            <form action="<?php echo FRONT_ROOT ?>Student/add" method= "post">
               <div>
                    <input type="email" name="email" placeholder="Ingresar email" required>
               </div>
               <div>
                    <input type="password" name="password" placeholder="Ingresar contraseña" required>
               </div>
               <button type="submit">Verificar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('./Views/footer.php'); ?>