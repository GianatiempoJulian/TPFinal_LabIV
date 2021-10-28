<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH. "zero.php");
           //header("location:" .FRONT_ROOT. "Student/ShowStudentProfile");
        }        
    }
?>