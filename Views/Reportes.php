<?php
session_start();
if (!isset($_SESSION['user']) ) {
 header('Location: Login.php');
}
?>    
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('Include/cabezera.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" style="width:1349px;">

        <!-- navegacion -->

        <?php include('Include/navegacion.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content-header">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->
                    <div class="row mb-2">

                        <!-- PROVEEDORES -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-green" style="height:119px;">
                                <div class="inner">
                                    <h1>Compras en<br>General</h1>
                                    <div class="icon">
                                        <i class="fas fas fa-truck"></i>
                                    </div>
                                </div>
                            <a class="small-box-footer" id="reporteGeneral" type="button">
                                    Generar Reporte <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- PRODUCTOS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-red" style="height:119px;">
                                <div class="inner">

                                    <h1>Compras<br>Específicas</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a class="small-box-footer" id="reporteGeneralPorProveedor" type="button">
                                    Generar Reporte <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- CLIENTES -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-gradient-orange" style="height:119px;">
                                <div class="inner">
                                    <h1 style="color:white;">Generar Ventas<br>Totales</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <a class="small-box-footer" id="reporteGeneralVentas" type="button">
                                    Generar Reporte <i class="fas fa-arrow-circle-right" style="color:white;"></i>
                                </a>
                            </div>
                        </div>

                        <!-- VENTAS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-blue" style="height:119px;">
                                <div class="inner">
                                    <h1>Reportes Tickets y Facturas</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                                <a class="small-box-footer" id="reporteGeneralImpresion" type="button">
                                    Generar Reporte <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="row">
                        <?php include('reportesGraficas/reportesGraficas.php'); ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>

        <!-- footer -->
        <?php include('Include/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <?php include('Include/scripts.php'); ?>
    <script src="dist/js/jspdf.min.js"></script>
    <script src="dist/js/jspdf.plugin.autotable.min.js"></script>
    <!-- Gráficas--> 
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="dist/js/scripts.js"></script>
    <script src="dist/js/simple-datatables@latest.js"></script>
    <script src="dist/js/datatables-simple-demo.js"></script>
    <script src="dist/js/pages/reporteGraficas.js"></script>
</body>

</html>