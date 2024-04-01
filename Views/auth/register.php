<?php include('./Views/header.php'); ?>

<body>
    <div id="root">
        <section class="container">
            <div class="register-container">
                <h1>Registrarse</h1>
                <form class="register-form" action="<?php echo FRONT_ROOT ?>Login/toType" method="post">
                <label id="rol-label-title" for="rol">Selecciona un rol</label>
                    <label class="rol-label">Estudiante</label>
                    <input type="radio" id="rol_student" value=0 name="type" required>
                    <label class="rol-label">Administrador</label>
                    <input type="radio" id="rol_administrator" value=1 name="type" required>
                    <label class="rol-label">Empresa</label>
                    <input type="radio" id="rol_administrator" value=2 name="type" required>
                    <button type="submit" class="btn-submit">Siguiente</button>
            </div>
</body>

<?php include('./Views/footer.php'); ?>
