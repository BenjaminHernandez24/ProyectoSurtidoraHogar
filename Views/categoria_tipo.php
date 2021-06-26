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

            <!---- Tabla Categoría-Tipo Productos ----->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button id="alta_tipo" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevo_cat_tipo">
                                    Agregar Tipo Producto
                                </button>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="tabCategoriaTipo" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>ID</th>
                                            <th>Tipo de Producto</th>
                                            
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
            <!-- /. Tabla Categoría-Tipo Productos  -->

        </div>
        <!-- ends content-wrapper -->
         <!------------------------ REGISTRO TIPO DE PRODUCTO------------------------->
         <div id="nuevo_cat_tipo" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_tipo_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Tipo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="des_tipo">Descripción de tipo Producto</label>
                                <input class="form-control" type="text" name="des_tipo" placeholder="Descripción de tipo" required>
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
        <!------------------------ EDITAR TIPO PRODUCTO ------------------------->
        <div id="editar_tipo_producto" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_editar_tipo">
                         <!--------------------- HEADER ----------------------->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <!----------------------- BODY ----------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="des_tipo">Descripción de tipo Producto</label>
                                <input class="form-control" type="text" id="des_tipo" name="des_tipo" placeholder="Descripción de Tipo" required>
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
    <script src="dist/js/pages/categoria_tipo.js"></script>

</body>
</html>