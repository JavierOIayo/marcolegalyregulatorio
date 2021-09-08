<?php

function PageName() {
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
//require_once 'user/privileges/display.php';
?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="./">
                    <div class="brand-logo"><img class="logo" src="origen/misfotos/logo_umg.png" /></div>
                    <h2 class="brand-text mb-0" style="color: green;">Grupo 2</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class="navigation-header"><span>Menú principal</span></li>
            <li class="<?php echo $current_page == 'index.php' ? 'active' : NULL ?> nav-item">
                <a href="./"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="desktop">Dashboard</span></a>
            </li>

            <li class="<?php echo $current_page == 'usuarios.php' ? 'active' : NULL ?> nav-item">
                <a href="usuarios.php"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="users">Usuarios</span></a>
            </li>

            <li class="<?php echo $current_page == 'listado.php' ? 'active' : NULL ?> nav-item">
                <a href="listado.php"><i class="menu-livicon" data-icon="balance"></i><span class="menu-title" data-i18n="balance">Leyes</span></a>
            </li>

            <li class="<?php echo $current_page == 'listado.php' ? 'active' : NULL ?> nav-item">
                <a href="listado.php"><i class="menu-livicon" data-icon="legal"></i><span class="menu-title" data-i18n="legal">Evaluaciones</span></a>
            </li>

            <li class="nav-item" style="display: <?php echo $profiles; ?>;">
                <a href="#"><i class="menu-livicon" data-icon="pie-chart"></i><span class="menu-title" data-i18n="pie-chart">Reportes</span></a>
                <ul class="menu-content">
                    <li class="<?php echo $current_page == '#.php' ? 'active' : NULL ?>">
                        <a href="#.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Reporte 1</span></a>
                    </li>
                    <li class="<?php echo $current_page == '#.php' ? 'active' : NULL ?>">
                        <a href="#.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Reporte 2</span></a>
                    </li>
                </ul>
            </li>

            <!-- <li class="nav-item">
                <a href="#"><i class="menu-livicon" data-icon="gears"></i><span class="menu-title" data-i18n="Gears">Ajustes</span></a>
                <ul class="menu-content">
                    <li class="<?php echo $current_page == '#.php' ? 'active' : NULL ?>">
                        <a href="#.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Asignar permisos</span></a>
                    </li>
                    <li class="<?php echo $current_page == 'escuela.php' ? 'active' : NULL ?>">
                        <a href="escuela.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Escuelas</span></a>
                    </li>
                    <li class="<?php echo $current_page == 'iglesia.php' ? 'active':NULL ?>">
                        <a href="iglesia.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Iglesias</span></a>
                    </li>
                    <li class="<?php echo $current_page == 'programa.php' ? 'active':NULL ?>">
                        <a href="programa.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Programas</span></a>
                    </li>
                </ul>
            </li> -->

            <li class="navigation-header"><span>Soporte</span></li>
            <li class="<?php echo $current_page == '#.php' ? 'active' : NULL ?>">
                <a href="#.php"><i class="menu-livicon" data-icon="bug"></i><span class="menu-title" data-i18n="Document">Reportar error</span></a>
            </li>
            <li class="navigation-header">
                <span>
                    Version
                    1.0.0
<?php // echo $version; ?>
                </span>
            </li>
            <li class="<?php echo $current_page == '#.php' ? 'active' : NULL ?> nav-item">
                <a href="#.php"><i class="menu-livicon" data-icon="rotate-right"></i><span class="menu-title" data-i18n="Rotate-right">Actualizaciones</span></a>
            </li>
        </ul>
    </div>
</div>
