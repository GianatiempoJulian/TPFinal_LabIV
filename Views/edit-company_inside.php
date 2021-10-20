<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

<?php

if($_POST){

    
$id = $_POST["comp_id"];
$option = $_POST["option_switch"];

    
?>
     <form action="company_mf-form.php" method= "post">
     <input type="number" class = "not_visible" name="comp_id" <?php echo "value=$id"?>>
         <input type="number" class = "not_visible" name="option" <?php echo "value=$option"?>>
<?php
       switch($option)
   {
       case 1:
        ?>
        
        <div class="add-company_form">
            <input type="text" name="new_value" placeholder="Ingresar nombre" required>
       </div>
       
       <?php
         break;
    
        case 2:
        ?>
        <div class="add-company_form">
        <
            <input type="text" name="new_value" placeholder="Ingresar tipo" required>
       </div>
      
       <?php
            break;
   }
   ?>
        <button type="submit" class="submit_button">Enviar</button>
   <?php
}
?>


<?php include('footer.php'); ?>