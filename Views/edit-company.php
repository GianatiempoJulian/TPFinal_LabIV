<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>

<?php
 if($_GET && isset($_GET["msg"])){
     switch($_GET["msg"]){
          case "editada":
?>
<h6>Empresa modificada con exito.</h6>
<?php
               break;      
     }
}
?>

<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Modifica una empresa</header>
            <form action="edit-company_inside.php" method= "post">
               <div class="add-company_form">
                    <input type="number" name="comp_id" placeholder="Ingresar ID" required>
               </div>
               <h2>Eliga su opcion</h2>
               <h3>1.Nombre</h3>
               <h3>2.Tipo</h3>
               <input type="number" name="option_switch" id="option_switch" placeholder="Ingresar opción "required>
               <button type="submit" class="submit_button">Buscar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>