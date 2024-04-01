<?php namespace Views?>
<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
    <div id="root vh90">
        <form action="<?php echo FRONT_ROOT ?>Company/remove" method= "post">
        <section class="container vh90">
            <div class="remove-company-container">
            <table class="company-table">
                <h1>Eliminar una empresa</h1>
                <input class="input input-remove" type="number" name="ud" placeholder="Ingresar ID para eliminar" required>
                    <tbody class="company-table-body">
                         <tr>
                         <?php 
                             foreach($companyList as $company){
                        ?>
                             <th class="company company-remove"><?php echo $company->getId()?><br><?php echo $company->getName()?> <br> <?php echo $company->getType()?> <a href="<?php echo FRONT_ROOT ?>Company/remove/<?php echo $company->getId()?>">Eliminar</a></th>
                         </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
               <button class="btn-submit" type="submit">Enviar</button>
            </div>
        </section>
        </form>
    </div>
</body>
</html>

<?php include('./Views/footer.php'); ?>