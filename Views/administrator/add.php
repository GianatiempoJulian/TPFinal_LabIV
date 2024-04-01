<?php include('./Views/header.php'); ?>
<?php include('./Views/nav.php'); ?>


<body>
    <div id="root">
        <section class="container">
            <div class="add-user-container">
            <h1>Agrega un administrador</h1>
            <form class="add-user-form" action="<?php echo FRONT_ROOT ?>Administrator/add" method="post">
                <input class="input" type="text" name="firstname" placeholder="Ingresar nombre" required>
                <input class="input" type="text" name="lastname" placeholder="Ingresar apellido" required>
                <input class="input" type="email" name="email" placeholder="Ingresar correo" required>
                <input class="input" type="password" name="password" placeholder="Ingresar contraseña" required>
                <button class="btn-submit" type="submit">Siguiente</button>
            </form>
            </div>
        </section>
    </div>
</body>
       
<?php include('./Views/footer.php'); ?>
