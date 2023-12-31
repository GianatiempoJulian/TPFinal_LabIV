<nav>
    <img src="<?php echo IMG_PATH?>logo_placeholder.png" alt="logo">
        <ul>
            <li></li>
            <li><a href="<?php echo FRONT_ROOT ?>Company/showCompanyById/<?php echo $_SESSION['id_comp']?>">Mi Perfil</a></li>
            <li>|</li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showAddView">Agregar Oferta</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showRemoveView">Baja Oferta </a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showAltaView">Alta Oferta </a></li>
            <li>|</li>
            <li ><a class="nav-logout" href="<?php echo FRONT_ROOT?>Login/logOut" >Cerrar Sesión</a></li>
        </ul>
    </nav>