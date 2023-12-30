<?php

namespace DAO;

class MessageDAO {
            public function studentAccessDeniedMessage()
            {
                $errorMessageJS = addslashes('Acceso no permitido para estudiantes.');
                echo "<script>window.history.go(-1); alert('Error: $errorMessageJS');</script>";
            }
    
            public function notLoggedMessage()
            {
                header("location:" . FRONT_ROOT . "Home/Index?status=0");
            }
}

?>

