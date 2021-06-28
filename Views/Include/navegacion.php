<?php
if (!isset($_SESSION['user'])) {
    session_start();
}
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #F29F05;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars" style="color:white"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="btn-group" role="group">
            <button style="color:white; font-size: 20px;" id="btnGroupDrop1" type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administrador
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="background-color: #F29F05; font-size: 20px;">
                <a class="dropdown-item nav-link" href="#" style="color:white"><i class="nav-icon fas fa-sliders-h" style="color:white"> Ajustes</i></a>
                <a class="dropdown-item nav-link" href="../Views/Ayuda.php" style="color:white" target="_blank"><i class="nav-icon fas fa-question-circle" style="color:white"> Ayuda</i></a>
                <a class="dropdown-item nav-link" href="#" style="color:white"><i class="nav-icon fas fa-info-circle" style="color:white"> Acerca De</i></a>
                <a class="dropdown-item nav-link" href="../Views/Include/cerrarsesion.php" style="color:white"><i class="nav-icon fas fa-sign-out-alt" style="color:white"> Salir</i></a>
            </div>
        </div>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #F29F05;">
    <!-- Brand Logo -->
    <?php if ($_SESSION['user'] == "Empleado") { ?>
        <a href="../Views/principal.php" class="brand-link">
            <img src="dist/img/letraE.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Surtidora del Hogar</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/empleados.png" class="img-circle elevation-2" alt="User Image">
                </div>



                <div class="info">
                    <a href="../Views/principal.php" class="d-block">Empleado</a>
                </div>

            <?php } else if ($_SESSION['user'] == "Administrador") { ?>

                <a href="../Views/principal.php" class="brand-link">
                    <img src="dist/img/letraA.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Surtidora del Hogar</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
                        </div>

                        <div class="info">
                            <a href="../Views/principal.php" class="d-block" style="color:white">Administrador</a>
                        </div>

                    <?php } ?>
                    </div>

                    <!----------------------------------Menú de Administrador --------------------------------->


                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                              with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <a href="../Views/Venta.php" class="nav-link">
                                    <i class="nav-icon fas fa-cart-arrow-down" style="color:white"></i>
                                    <p style="color:white; font-size: 25px;">
                                        Ventas
                                    </p>
                                </a>
                            </li>
                            <?php if ($_SESSION['user'] == "Administrador") { ?>

                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-box" style="color:white"></i>
                                        <p style="color:white; font-size: 25px;">
                                            Productos
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../Views/categoria_tipo.php" class="nav-link">
                                                <i class="nav-icon fas fa-box-open" style="color:white"></i>
                                                <p style="color:white; font-size: 20px;">Productos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../Views/categoria_tipo.php" class="nav-link">
                                                <i class="nav-icon fas fa-boxes" style="color:white"></i>
                                                <p style="color:white; font-size: 20px;">Tipo de Producto</p>
                                            </a>
                                        </li>
                                </li>
                                <li class="nav-item">
                                    <a href="../Views/categoria_marca.php" class="nav-link">
                                        <i class="nav-icon fas fa-boxes" style="color:white"></i>
                                        <p style="color:white; font-size: 20px;">Marca de Producto</p>
                                    </a>
                                </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../Views/proveedores.php" class="nav-link">
                                <i class="nav-icon fas fa-truck" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Proveedores
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../Views/Clientes.php" class="nav-link">
                                <i class="nav-icon fas fa-users" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Clientes
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-alt" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Reportes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/boxed.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Boxed</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Navbar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-footer.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Footer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Collapsed Sidebar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <?php } ?>

                    </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
</aside>