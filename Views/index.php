<?php require_once("header.php"); ?>
        <?php
        
        if(isset($_GET['status']) && $_GET['status'] == 0)
        {
        ?>
            <h1>Debes iniciar sesión para acceder a esta sección.</h1>
        <?php
        }
        ?>
    <div id="root">
        <section class="container">
            <div class="auth-container">
                <h1>Bienvenido a UTNJobs</h1>
                    <h2><a href="<?php echo FRONT_ROOT?>Login/showLoginView">Inicia Sesión</a></h2>
                    <h2><a href="<?php echo FRONT_ROOT?>Login/showRegisterView">Registrarse</a></h2>
            </div>
        </section>
    </div>
<?php include('footer.php'); ?>



