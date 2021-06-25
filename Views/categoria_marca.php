<!doctype html>
<html lang="en">

<head>
    <?php include("include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?php include("include/navegacion.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Tabla Categoría Productos -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button id="alta_marca" class="btn btn-outline-primary" data-toggle="modal" data-target="#nueva_categoria">
                                    Agregar Marca Producto
                                </button>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="tab_categoria" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>Id</th>
                                            <th>Marca Producto</th>
                                            
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. TABLA PROVEEDORES -->

        </div>
        <!-- ends content-wrapper -->




        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/.js"></script>

</body>

</html>