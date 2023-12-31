<nav>
    <img src="<?php echo IMG_PATH?>logo_placeholder.png" alt="logo">
        <ul>
            <li><a href="<?php echo FRONT_ROOT ?>User/showUserProfile">Mi Perfil</a></li>
            <li>|</li>

            <li><a href="<?php echo FRONT_ROOT ?>User/showAddView">Agregar Usuario</a></li>
            <li>|</li>

            <li><a href="<?php echo FRONT_ROOT?>Company/showListView">Empresas</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Company/showAddView">Agregar Empresa</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Company/showRemoveView">Baja Empresa</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Company/showAltaView">Alta Empresa</a></li>
            <li>|</li>
            <li><a href="<?php echo FRONT_ROOT?>JobOffer/showListView">Ofertas</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showAddView">Agregar Oferta </a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showRemoveView">Baja Oferta </a></li>
            <li><a href="<?php echo FRONT_ROOT ?>JobOffer/showAltaView">Alta Oferta </a></li>
            <li>|</li>
            <li ><a class="nav-logout" href="<?php echo FRONT_ROOT?>Login/logOut" >Cerrar Sesión</a></li>
       
            
        </ul>
    </nav>