<?php include('header.php'); ?>

<?php ?>

<?php

     session_start();

     if(isset($_SESSION["username"]))
     {
          header("location:nav.php"); ///si la sesion esta iniciada te manda de una al nav.
     }
     
?>

<?php
     if($_GET && isset($_GET["msg"])){
          switch($_GET["msg"]){
               case "incorrect":
?>
<h6>Username y/o password incorrecto.</h6>
<?php
                    break;
               case "without_session":
?>
<h6>Inicia sesión para acceder a este sitio.</h6>
<?php  
                    break;  
                    
          }
     }
?>

<body>
    
    <article id="login_article">
        <section id="login_section">
            <header id="front_text">Iniciar sesión en PLACEHOLDER</header>
            <form action="session.php" method="post">
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