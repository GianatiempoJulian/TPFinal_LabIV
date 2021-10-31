<?php namespace Views?>


<?php include('header.php');?>
<?php include('nav.php'); ?>



<body>
    <article id="add-company_article">
        <section id="add-company_secton">
            <header id="front_text">Agrega un alumno</header>
            <form action="<?php echo FRONT_ROOT ?>Student/Add" method= "post">
               <div class="add-company_form">
                    <input type="text" name="firstName" placeholder="Ingresar nombre" required>
               </div>
               <div class="add-company_form">
                    <input type="text" name="lastName" placeholder="Ingresar apellido" required>
               </div>
               <div class="add-company_form">
                    <input type="number" name="recordId" placeholder="Ingresar legajo" required>
               </div>
               <div class="add-company_form">
                    <input type="email" name="email" placeholder="Ingresar email" required>
               </div>
               <div class="add-company_form">
                    <input type="number" name="careerId" placeholder="Ingresar ID de Carrera" required>
               </div>
               <div class="add-company_form">
                    <input type="number" name="dni" placeholder="Ingresar DNI" required>
               </div>
               <div class="add-company_form">
                    <input type="number" name="fileNumber" placeholder="Ingresar numero de archivo" required>
               </div>
               <div class="add-company_form">
                    <input type="gender" name="gender" placeholder="Ingresar género" required>
               </div>
               <div class="add-company_form">
                    <input type="date" name="birthDate" placeholder="Ingresar fecha de cumpleaños" required>
               </div>
               <div class="add-company_form">
                    <input type="number" name="phoneNumber" placeholder="Ingresar numero telefonico" required>
               </div>
               <button type="submit" class="submit_button">Agregar</button>
             </form>
        </section>
    </article>
</body>
</html>

<?php include('footer.php'); ?>