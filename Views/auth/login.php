<?php include('./Views/header.php'); ?>

<?php

    
     if(isset($_SESSION["email"]))
     {
          require_once(VIEWS_PATH. "/administrator/profile.php");
     }
     
?>

<body>
    <div id="root">
        <section class="container">
          <div class="login-container">
               <h1>Iniciar sesión</h1>
               <form class="login-form" action="<?php echo FRONT_ROOT?>Login/verify" method="post">
                    <div>
                         <input class="input" type="email" name="email" placeholder="Ingresar correo" required>
                    </div>
                    <div>
                         <input class="input" type="password" name="password" placeholder="Ingresar constraseña" required>
                    </div>
                    <button class="btn-submit" type="submit">Iniciar Sesión</button>
               </form>
               </div>
        </section>
     </div>
</body>
</html>
<?php include('./Views/footer.php'); ?>