<?php
if (!isset($_SESSION['user'])) {
    session_start();
}
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #F29D35;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars" style="color:white"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!--AQUI INICIA LO DE NOTIFICACIONES-->
        <div class="btn-group" role="group" style="color:black;" style="display:none;">
            <div class="nav-link">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" type="button" onclick="apretarBotonNotificacion();">
                        <i class="far fa-bell"></i>
                        <span id="contador" name="contador" class="badge badge-danger navbar-badge count" style="border-radius:20px;font-size:12px;"></span>
                    </a>
                    <div class="btnTodo" id="todo">
                        <ul id="menu" name="menu" class="dropdown-menu dropdown-menu-lg dropdown-menu-right"></ul>
                    </div>
                </li>
            </div>
        </div>
        <!--AQUI TERMINA-->

        <div class="btn-group" role="group" style="color:black;">
            <?php if ($_SESSION['user'] == "Empleado") { ?>
                <button style="color:white; font-size: 20px;" id="btnGroupDrop1" type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                    Empleado
                </button>
            <?php } else if ($_SESSION['user'] == "Administrador1" || $_SESSION['user'] == "Administrador2") { ?>
                <button style="color:white; font-size: 20px;" id="btnGroupDrop1" type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                    Administrador
                </button>
            <?php } ?>
            <ul class="dropdown-menu" style="font-size: 20px;">
                <li><a class="dropdown-item nav-link" href="../Views/Ajustes.php"><i class="nav-icon fas fa-sliders-h" style="color:#F29F05;"> Ajustes</i></a></li>
                <li><a class="dropdown-item nav-link" href="../Views/Ayuda.php" style="color:white" target="_blank"><i class="nav-icon fas fa-question-circle" style="color:#F29F05;"> Ayuda</i></a></li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item nav-link" href="../Views/Include/cerrarsesion.php" style="color:white"><i class="nav-icon fas fa-sign-out-alt" style="color:#F29F05;"> Salir</i></a></li>
            </ul>
        </div>
    </ul>
</nav>
<!-- /.navbar -->

<!--Aqui Inicia Modal de Notificaciones-->
<div id="modalFrmNotificacion" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--=====================================
                HEADER DEL MODAL
                ======================================-->
            <div class="modal-header" id="tituloModal">
                <i class="nav-icon fas fa-bell" style="color:#F29F05; font-size: 30px;"> Notificaciones</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <!--=====================================
                CUERPO DEL MODAL
                ====================================== -->
            <div class="modal-body">
                <div class="card">
                    <!-- TABLA CLIENTES -->
                    <table id="tblNotificacion" class="table table-light text-justify">
                        <thead class="thead-light">
                            <tr class="table table-dark">
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Producto</th>
                                <th>Recomendacion</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- /. TABLA CLIENTES -->
                </div>
            </div>
            <!--=====================================
                PIE DEL MODAL
                ======================================-->
        </div>
    </div>
</div>
<!--Aqui Termina -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #F29D35;">
    <!-- Brand Logo -->
    <!-- SECCIÓN DE LOGO DE EMPRESA Y NOMBRE: EMPLEADO. Parte superior izquierda. -->
    <?php if ($_SESSION['user'] == "Empleado") { ?>
        <a href="../Views/Principal.php" class="brand-link">
            <img src="dist/img/surtidora.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                    <a href="../Views/Principal.php" class="d-block">Empleado</a>
                </div>
                <!-- SECCIÓN DE LOGO DE EMPRESA Y NOMBRE: USUARIO. Parte superior izquierda. -->
            <?php } else if ($_SESSION['user'] == "Administrador1" || $_SESSION['user'] == "Administrador2") { ?>

                <a href="../Views/Principal.php" class="brand-link">
                    <img src="dist/img/surtidora.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                            <a href="../Views/Principal.php" class="d-block" style="color:white">Administrador</a>
                        </div>
                    <?php } ?>
                    </div>
                    <!--------------------------------Menú de Empleado --------------------------------->
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

                            <!-------------------------------Menú de Administrador ------------------------------>
                            <?php if ($_SESSION['user'] == "Administrador1" || $_SESSION['user'] == "Administrador2") { ?>

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
                                            <a href="../Views/Productos.php" class="nav-link">
                                                <i class="nav-icon fas fa-box-open" style="color:white"></i>
                                                <p style="color:white; font-size: 20px;"> Agregar Productos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../Views/Categoria_Tipo.php" class="nav-link">
                                                <i class="nav-icon fas fa-boxes" style="color:white"></i>
                                                <p style="color:white; font-size: 20px;"> Agregar Tipo </p>
                                            </a>
                                        </li>
                                </li>
                                <li class="nav-item">
                                    <a href="../Views/Categoria_Marca.php" class="nav-link">
                                        <i class="nav-icon fas fa-boxes" style="color:white"></i>
                                        <p style="color:white; font-size: 20px;">Agregar Marca</p>
                                    </a>
                                </li>
                        </ul>
                        </li>
                        <!-------//</li>------->
                        <li class="nav-item">
                            <a href="../Views/Inventario.php" class="nav-link">
                                <i class="nav-icon fas fa-dolly-flatbed" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Inventario
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../Views/Compras.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-bag" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Compras
                                </p>
                            </a>
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
                            <a href="../Views/Reportes.php" class="nav-link">
                                <i class="nav-icon fas fa-file-alt" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Reportes
                                </p>
                            </a>
                        </li>

                        
                        <li class="nav-item has-treeview">
                            <a href="" id="boton_factura" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Ticket/Factura
                                </p>
                            </a>
                        </li>
                        <?php } else if ($_SESSION['user'] == "Empleado") { ?>
                            <li class="nav-item has-treeview">
                            <a href="" id="boton_factura" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list" style="color:white"></i>
                                <p style="color:white; font-size: 25px;">
                                    Ticket/Factura
                                </p>
                            </a>
                        </li>
                        <?php }  ?>
                    
                    </ul>
                    <!-- ul -->
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
</aside>