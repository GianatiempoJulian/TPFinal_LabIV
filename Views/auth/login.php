<?php include('./Views/header.php'); ?>

<?php

    
     if(isset($_SESSION["user_mail"]))
     {
          header("location:/user/profile.php"); ///si la sesion esta iniciada te manda de una al profile
     }
     
?>

<body>
    <div id="root">
        <section class="container">
          <div class="login-container">
               <h1>Iniciar sesión</h1>
               <form class="login-form" action="<?php echo FRONT_ROOT?>Login/Verify" method="post">
                    <div>
                         <input class="input" type="email" name="user_mail" placeholder="Ingresar correo" required>
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