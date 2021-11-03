<?php include('header.php'); ?>

    <article>
        <section>
        <form action="<?php echo FRONT_ROOT ?>User/Add" method="post">
        
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="firstname" placeholder="Ingresar nombre" required>
        </div>
        <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="lastname" placeholder="Ingresar apellido" required>
        </div>
        <div class="form-group">
            <label for="">Correo</label>
            <input type="email" name="email" placeholder="Ingresar correo" required>
        </div>
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" name="password" placeholder="Ingresar contraseña" required>
        </div>
        </section>
        <button type="submit" class="submit_button">Siguiente</button>
    </article>
    
<?php include('footer.php'); ?>
