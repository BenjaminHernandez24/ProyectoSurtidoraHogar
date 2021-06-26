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
                                <button id="alta_marca" class="btn btn-outline-primary" data-toggle="modal" data-target="#nueva_marca">
                                    Agregar Marca Producto
                                </button>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="tab_categoria_marca" class="table table-light">
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
            <!-- /. TABLA MARCA PRODUCTO -->

        </div>
        <!-- ends content-wrapper -->

        <!------------------------ REGISTRO MARCA DE PRODUCTO------------------------->
        <div id="nueva_marca" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_marca_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Marca Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="des_marca">Descripción de marca Producto</label>
                                <input class="form-control" type="text" name="des_marca" placeholder="Descripción de marca" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!------------------------ EDITAR MARCA PRODUCTO ------------------------->
        <div id="editar_marca_producto" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_editar_marca">
                         <!--------------------- HEADER ----------------------->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Marca Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <!----------------------- BODY ----------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="des_marca">Descripción de marca Producto</label>
                                <input class="form-control" type="text" id="des_marca" name="des_marca" placeholder="Descripción de Marca" required>
                            </div>
                        </div>
                         <!---------------------- FOOTER ----------------------->
                        <div class="modal-footer">
                            <button id="cerrarEditar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/categoria_marca.js"></script>

</body>

</html>