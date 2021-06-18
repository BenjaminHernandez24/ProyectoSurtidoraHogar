<?php
//require_once "../controllers/EstadisticasController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include("include/navegacion.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark">¡Bievenido al sistema!</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <!-- USUARIO -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Proveedores</div>
                                            <div class="h5 mb-0 font-weight-bold text-white"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-truck fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PRODUCTOS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-secondary border-0 shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Productos</div>
                                            <div class="h5 mb-0 font-weight-bold text-white"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box-open fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CLIENTES -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Clientes</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- VENTAS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 bg-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Ventas</div>
                                            <div class="h5 mb-0 font-weight-bold text-white"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cart-arrow-down fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- ./col -->
                </div>


        </div><!-- /.container-fluid -->

        </section>

        <!-- /.content -->
    </div>


    <?php include("include/footer.php") ?>

    </div>
    <!-- ./wrapper -->
    <?php include("Include/scripts.php"); ?>
</body>

</html>