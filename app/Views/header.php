<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- FONTAWESOME -->
    <link href="<?= ROOT; ?>vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- JQUERY -->
    <script src="<?= ROOT; ?>node_modules/jquery/dist/jquery.min.js"></script>
    
    <!-- SWEETALERT -->
    <link rel="stylesheet" href="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- BOOTSTRAP -->
    <link href="<?= ROOT; ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- BOOTADMIN -->
    <link href="<?= ROOT; ?>public/assets/css/bootadmin.min.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link href="<?= ROOT; ?>public/assets/css/notifications.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="<?= ROOT; ?>public/assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- DATATABLE -->
    <link href="<?= ROOT; ?>vendor/datatables/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?= ROOT; ?>public/assets/img/w&cLogoFavicon.png" type="image/x-icon">

    <title><?php 
        if(isset($_COOKIE['title'])){
            echo $_COOKIE['title'];
        }
        else{
            echo "World & Computer";
        }
    ?></title>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-primary w-100" id="navbar">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="<?= ROOT;?>">
        <img src="<?= ROOT; ?>public/assets/img/w&cLogoMiniWhite.png" alt="" style="height:30px; max-height:50%">
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <div class="">
                <div id="cantidadNotificaciones" style="display: none;"></div>
            </div>
            <li class="nav-item">
                <i class="fas fa-bell nav-link" id="bell"></i>
                <div class="notifications" id="box" style="display: none;">
                    <h2>Notificaciones <i id="getout" class="fas fa-times"></i></h2>
                    <!-- <div class="notifications-item"> <img src="https://i.imgur.com/uIgDDDd.jpg" alt="img">
                        <div class="text">
                            <h4>Samso aliao</h4>
                            <p>Samso Nagaro Like your home work</p>
                        </div>
                    </div> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= empty($_SESSION['usuario']) ? 'Usuario' : $_SESSION['usuario'] ?></a>
                <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dd_user">
                    <a href="<?= ROOT;?>perfil" class="dropdown-item text-light">Perfil</a>
                    <?php
                        if($_SESSION['rol']==1){
                    ?>
                    <!-- <a href="<?= ROOT;?>bitacora" class="dropdown-item text-light">Consultar Bitácora</a> -->
                    <a href="<?= ROOT;?>respaldo" class="dropdown-item text-light">Respaldar Base de Datos</a>
                    <a href="<?= ROOT;?>configuracion" class="dropdown-item text-light">Configuración</a>
                    <?php
                        }
                    ?>
                    <a href="<?= ROOT;?>public/assets/Manual de Usuario.pdf" target="blank" class="dropdown-item text-light">Ayuda</a>
                    <a href="" id="logout" class="dropdown-item text-light">Salir</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
	<!-- MENU -->
<div class="d-flex">
	<div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <?php 
                $seguridad=false;
                foreach ($_SESSION['permisos'] as $p):
                    
                    if (($p->permiso == "Usuarios"||$p->permiso == "Roles"||$p->permiso == "Bitacora"||$_SESSION['rol']==1)&&!$seguridad) {
                        $seguridad = true;     
            ?>
            <!-- <li><a href="<?= ROOT;?>Usuario"><i class="fa fa-fw fa-user"></i> Usuarios</a></li> -->
            <li>
                <a href="#seguridad_collapse" data-toggle="collapse">
                    <i class="fa fa-fw fa-lock"></i> Seguridad
                </a>
                <ul id="seguridad_collapse" class="list-unstyled collapse">
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Usuarios") {     
                    ?>
                        <li><a href="<?= ROOT;?>Usuario"><i class="fa fa-fw fa-user"></i> Usuarios</a></li>
                    <?php
                        }endforeach;                
                    ?>
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Roles") {     
                    ?>
                  
                        <li><a href="<?= ROOT;?>Rol"><i class="fa fa-fw fa-address-card"></i> Roles</a></li>
                       
                    <?php
                        }endforeach;                
                    ?>
                    <?php 
                        if ($_SESSION['rol']==1) {     
                    ?>
                  
                        <li><a href="<?= ROOT;?>Bitacora"><i class="fa fa-fw fa-receipt"></i> Bitácora</a></li>
                       
                    <?php
                        }              
                    ?>
                </ul>
            </li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Empleados") {     
            ?>
            <li><a href="<?= ROOT;?>Empleado"><i class="fa fa-fw fa-wrench"></i> Empleados</a></li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Clientes") {     
            ?>
            <li><a href="<?= ROOT;?>Cliente"><i class="fa fa-fw fa-users"></i> Clientes</a></li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Proveedores") {     
            ?>
            <li><a href="<?= ROOT;?>Proveedor"><i class="fa fa-fw fa-truck"></i> Proveedores</a></li>
            <?php
                }endforeach;                
            ?>
            <!-- <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Inventario") {     
            ?>
            <li>
                <a href="#inventory_collapse" data-toggle="collapse">
                    <i class="fa fa-fw fa-chart-area"></i> Inventario
                </a>

                <ul id="inventory_collapse" class="list-unstyled collapse">
                    <li><a href="<?= ROOT;?>Inventario"><i class="fa fa-fw fa-bookmark"></i> Resumen</a></li>

                </ul>
            </li>
            <?php
                }endforeach;                
            ?> -->
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Productos") {     
            ?>
            <li><a href="<?= ROOT;?>Producto"><i class="fa fa-fw fa-sitemap"></i> Productos</a></li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Categorias") {     
            ?>
            <li><a href="<?= ROOT;?>Categoria"><i class="fa fa-fw fa-tag"></i> Categorías</a></li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Compras") {     
            ?>
            <li>
                <a href="#compra_collapse" data-toggle="collapse">
                    <i class="fa fa-fw fa-shopping-cart"></i> Compras
                </a>
                <ul id="compra_collapse" class="list-unstyled collapse">
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Registrar Compras") {     
                    ?>
                    <li><a href="<?= ROOT;?>Compra/create"><i class="fa fa-fw fa-plus-square"></i> Registrar</a></li>
                    <?php
                        }endforeach;                
                    ?>
                    <li><a href="<?= ROOT;?>Compra"><i class="fa fa-fw fa-bookmark"></i> Consultar</a></li>
                </ul>
            </li>
            <?php
                }endforeach;                
            ?>
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Ventas") {     
            ?>
            <li>
                <a href="#venta_collapse" data-toggle="collapse">
                    <i class="fa fa-fw fa-dollar-sign"></i> Ventas
                </a>
                <ul id="venta_collapse" class="list-unstyled collapse">
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Registrar Ventas") {     
                    ?>
                    <li><a href="<?= ROOT;?>Venta/crear"><i class="fa fa-fw fa-plus-square"></i> Registrar</a></li>
                    <?php
                        }endforeach;                
                    ?>
                    <li><a href="<?= ROOT;?>Venta"><i class="fa fa-fw fa-bookmark"></i> Consultar</a></li>
                </ul>
            </li>
            <?php
                }endforeach;                
            ?>
            <?php 
                $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Servicios" || $p->permiso == "Servicios Prestados" && !$band) {     
            ?>
            <li>
                <a href="#services_collapse" data-toggle="collapse">
                    <i class="fa fa-fw fa-handshake"></i> Servicios
                </a>

                <ul id="services_collapse" class="list-unstyled collapse">
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Servicios") {     
                    ?>
                    <li><a href="<?= ROOT;?>Servicio"><i class="fa fa-fw fa-hand-holding"></i> Servicios</a></li>
                    <?php
                        }endforeach;                
                    ?>
                    <?php foreach ($_SESSION['permisos'] as $p):
                        if ($p->permiso == "Servicios Prestados") {     
                    ?>
                    <li>
                        <a href="#servicio_prestado_collapse" data-toggle="collapse">
                            <i class="fa fa-fw fa fa-fw fa-hand-holding-usd "></i> Servicios Prestados
                        </a>
                        <ul id="servicio_prestado_collapse" class="list-unstyled collapse">
                            <?php foreach ($_SESSION['permisos'] as $p):
                                if ($p->permiso == "Registrar Servicios Prestados") {     
                            ?>
                            <li><a href="<?= ROOT;?>Servicio/create"><i class="fa fa-fw fa-plus-square"></i> Registrar</a></li>
                            <?php
                                }endforeach;                
                            ?>
                            <li><a href="<?= ROOT;?>Servicio/ProvidedServices"><i class="fa fa-fw fa-bookmark"></i> Consultar</a></li>
                        </ul>
                    </li>
                    <?php
                        }endforeach;                
                    ?>
                </ul>
            </li>
            <?php
                $band = true;
                }endforeach;                
            ?>
            <!-- <li><a href="<?= ROOT;?>Venta/Crear"><i class="fa fa-fw fa-shopping-basket"></i> Caja</a></li> -->
        
            
            <?php foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Reportes") {     
            ?>
            <li><a href="<?= ROOT;?>Reporte"><i class="fa fa-fw fa-calendar"></i> Reportes</a></li>
            <?php
                }endforeach;                
            ?>
        </ul>
    </div>