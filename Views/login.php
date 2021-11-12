<?php include('header.php'); ?>

<?php

    
     if(isset($_SESSION["user_mail"]))
     {
          header("location:student_profile.php"); ///si la sesion esta iniciada te manda de una al profile
     }
     
?>



<body>
    
    <article id="login_article">
        <section id="login_section">
            <header id="front_text">Iniciar sesión en UTNJobs</header>
            <form action="<?php echo FRONT_ROOT?>Login/Verify" method="post">
               <div class="login_form">
                    <input type="email" name="user_mail" placeholder="Ingresar correo" required>
               </div>
               <div class="login_form">
                    <input type="password" name="password" placeholder="Ingresar constraseña" required>
               </div>
               <button type="submit" class="submit_button">Iniciar Sesión</button>
             </form>
        </section>
    </article>
</body>
</html>
<?php include('footer.php'); ?>