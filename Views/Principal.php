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


            <!-- Main content -->
            <section class="content-header">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->
                    <div class="row mb-2">

                        <!-- PROVEEDORES -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>150</h3>

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
                                    <h3>150</h3>

                                    <h1>Productos</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <a href="../Views/Clientes.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- CLIENTES -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 style="color:white;">150</h3>

                                    <h1 style="color:white;">Clientes</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="../Views/Clientes.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right" style="color:white;"></i>
                                </a>
                            </div>
                        </div>

                        <!-- VENTAS -->
                        <div class="col-lg-3 col-6" class="small-box-footer">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>150</h3>

                                    <h1>Ventas</h1>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                                <a href="../Views/Clientes.php" class="small-box-footer">
                                    Acceder <i class="fas fa-arrow-circle-right"></i>
                                </a>
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