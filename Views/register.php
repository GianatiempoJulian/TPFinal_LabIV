<?php include('header.php'); ?>

    <article >
        <section>
        <form action="<?php echo FRONT_ROOT ?>Login/toType" method="post">
        
        <label for="rol"> Rol: </label>
            <input type="radio" id="rol_student" value=0 name="type">
            <label for="male">Estudiante</label>
            <input type="radio" id="rol_administrator" value=1 name="type">
            <label for="female">Administrador</label>
            <input type="radio" id="rol_administrator" value=2 name="type">
            <label for="female">Empresa</label>
        </section>
        <button type="submit" class="submit_button">Siguiente</button>
    </article>
    
<?php include('footer.php'); ?>
