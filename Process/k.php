<?php ///para que no pueda entrar si no tiene la sesión iniciada

     session_start();

     if(isset($_SESSION["username"]))
     {
          $username = $_SESSION["username"];
     }
     else
     {
          header("location:index.php?msg=without_session");
     }

?>