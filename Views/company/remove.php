<?php namespace Views?>
<?php include('./Views/header.php');?>
<?php include('./Views/nav.php'); ?>



<body>
    <div id="root vh90">
        <form action="<?php echo FRONT_ROOT ?>Company/remove" method= "post">
        <section class="container vh90">
            <div class="altabaja-company-container">
            <table class="company-table">
                <h1>Dar de baja una empresa</h1>
                <input class="input input-altabaja" type="number" name="comp_id" placeholder="Ingresar ID para dar de baja" required>
                    <tbody class="company-table-body">
                         <tr>
                         <?php 
                             foreach($companyList as $company){
                        ?>
                             <th class="company company-altabaja"><?php echo $company->getComp_id()?><br><?php echo $company->getComp_name()?> <br> <?php echo $company->getComp_type()?> <a href="<?php echo FRONT_ROOT ?>Company/remove/<?php echo $company->getComp_id()?>">Eliminar</a></th>
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