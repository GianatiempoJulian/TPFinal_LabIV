<?php include('header.php'); ?>

    <article>
        <section>
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="user_username" placeholder="Ingresar nombre" required>
        </div>
        <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="user_surname" placeholder="Ingresar apellido" required>
        </div>
        <div class="form-group">
            <label for="">Correo</label>
            <input type="email" name="user_email" placeholder="Ingresar correo" required>
        </div>
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" name="user_password" placeholder="Ingresar contraseña" required>
        </div>
        <div class="form-group">
            <label for="">Ciudad</label>
            <input type="text" name="user_city" placeholder="Ingresar ciudad" required>
        </div>

        <label for="rol"> Rol: </label>
            <input type="radio" id="rol_student" value="rol_student" name="user_rol">
            <label for="male">Estudiante</label>
            <input type="radio" id="rol_employer" value="rol_employer" name="user_rol">
            <label for="female">Empleador</label>
            <input type="radio" id="rol_administrator" value="rol_administrator" name="user_rol">
            <label for="female">Administrador</label>
        </section>
    </article>
    
<?php include('footer.php'); ?>
