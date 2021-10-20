<?php
namespace Views;

   require_once ("../DAO/StudentDAO.php");
   require_once ("../DAO/IStudentDAO.php");
   require_once("../Models/Student.php");

   use DAO\StudentDAO as StudentDAO;
   use DAO\IStudentDAO as IStudentDAO;
   use Models\Student as Student;

    if($_POST)
    {
      
        $mail = $_POST["user_mail"];
        $password = $_POST["password"];
        
    
        $studentList = new StudentDAO();
        $api_students = $studentList->GetAll();

    foreach ($api_students as $student)
    {
        //if(strcmp($mail,$student->getEmail) == 0 && $password == $student->getPassword)
        if(strcmp($mail,$student->getEmail()) == 0)
        {
            session_start();
            $_SESSION["user_mail"] = $mail;
            header("location: student_profile.php");
        }
        else{
            header("location: login.php?msg=incorrect");
        }
        
    }
    }

?>