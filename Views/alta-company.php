<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

<?php
 if($_GET && isset($_GET["msg"])){
     switch($_GET["msg"]){
          case "eliminada":
?>
<h6>Empresa eliinada con exito.</h6>
<?php
               break;      
     }
}
?>

<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Dar de alta una empresa</header>
            <form action="<?php echo FRONT_ROOT ?>Company/Alta" method= "post">
               <div class="add-company_form">
                    <input type="number" name="comp_id" placeholder="Ingresar ID para dar de alta" required>
               </div>
               <button type="submit" class="submit_button">Enviar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>