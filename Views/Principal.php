<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
}

require_once "../Controllers/EstadisticaController.php";

$ctr = new EstadisticasControlador();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('Include/cabezera.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- navegacion -->

        <?php include('Include/navegacion.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content-header">
                <div class="container-fluid">
                <?php if ($_SESSION['user'] == "Administrador1" || $_SESSION['user'] == "Administrador2") { ?>
                    <!-- Small boxes (Stat box) -->
                    <div class="row mb-2">
                     
                        <!-- PROVEEDORES -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php $ctr->printTotalProveedores(); ?></h3>

                                    <h1>Proveedores</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fas fa-truck"></i>
                                </div>
                                <a href="../Views/proveedores.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- PRODUCTOS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php $ctr->printTotalInventario(); ?></h3>

                                    <h1>Inventario</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <a href="../Views/Inventario.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- CLIENTES -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 style="color:white;">4</h3>

                                    <h1 style="color:white;">Reportes</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <a href="../Views/Reportes.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right" style="color:white;"></i>
                                </a>
                            </div>
                        </div>

                        <!-- VENTAS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3><?php $ctr->printTotalVentas(); ?></h3>

                                    <h1>Ventas</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                                <a href="../Views/Venta.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <?php } else if ($_SESSION['user'] == "Empleado") { ?>
                             <!-- VENTAS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3><?php $ctr->printTotalVentas(); ?></h3>

                                    <h1>Ventas</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                                <a href="../Views/Venta.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>
                    
                </div>
            </section>
           

            <?php include('FormulariosPrincipal/TablaVentasDia.php'); ?>

                <?php include('FormulariosPrincipal/FormatoGraficas.php'); ?>
        </div>
        <!-- footer -->
        <?php include('Include/footer.php'); ?>
      
    </div>
    <!-- ./wrapper -->
    
    <?php include('Include/scripts.php'); ?>
    <?php include("Include/tabla.php"); ?>
    <script src="dist/js/pages/Estadistica.js"></script>
</body>

</html>