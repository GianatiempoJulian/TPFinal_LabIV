<?php

   
    if($_POST)
    {
      
        $userName = $_POST["username"];
        $password = $_POST["password"];
        
    
        
        if(strcmp($userName,"admin@utn.com") == 0 && $password == "123456")
        {
            session_start();
            $_SESSION["username"] = $userName;
            header("location: nav.php");
        }
        else{
            header("location: msg=incorrect");
        }
        
    }

?>