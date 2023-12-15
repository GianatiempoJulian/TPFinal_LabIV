<nav>
    <img src="<?php echo IMG_PATH?>logo_placeholder.png" alt="logo">
        <ul>
            <li></li>
            <li><a href="<?php echo FRONT_ROOT ?>Company/ShowCompanyById/<?php echo $_SESSION['id_comp']?>">Mi Perfil</a></li>
            <li>|</li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddView">Agregar Oferta</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowRemoveView">Baja Oferta </a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/ShowAltaView">Alta Oferta </a></li>
            <li>|</li>
            <li ><a class="nav-logout" href="<?php echo FRONT_ROOT?>Login/LogOut" >Cerrar Sesión</a></li>
        </ul>
    </nav>