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
            <header id="front_text">Elimina una empresa</header>
            <form action="company_rm-form.php" method= "post">
               <div class="add-company_form">
                    <input type="number" name="comp_id" placeholder="Ingresar ID para eliminar" required>
               </div>
               <button type="submit" class="submit_button">Buscar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>