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

            <!-- TABLA CLIENTES -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button id="altaCliente" class="btn btn-outline-primary bg-primary" data-toggle="modal" data-target="#nuevo_cliente">
                                    Agregar Nuevo Cliente
                                </button>
                            </div>
                            <!-- /.card-header -->

                                <table class="table table-light text-center" id="tblClientes">
                                    <thead class="thead-light">
                                        <tr class="table table-dark text-center">
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Telefono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. TABLA CLIENTES -->

        </div>
        <!-- ends content-wrapper -->


        <!--=====================================
        MODAL AGREGAR NUEVO CLIENTE
        ======================================-->
        <div id="nuevo_cliente" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmClientes">
                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombre Cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo">Tipo</label>
                               <!-- <input class="form-control" type="text" name="tipo" placeholder="Tipo" required>-->
                               <select class="form-control" name="tipo" name="tipo">
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Técnico">Técnico</option>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono">Teléfono</label>
                                <input class="form-control" type="text" name="telefono" placeholder="Teléfono" required>
                            </div>
                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                        <div class="modal-footer">
                            <button id="closeEdit" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--=====================================
        MODAL EDITAR CATEGORIA 
        ======================================-->

        <div id="modalEditarCategoria" class="modal fade" role="dialog">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form id="formEditCategoria">

                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->

                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre Cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo">Tipo</label>
                                <!--<input id="tipo" class="form-control" type="text" name="tipo" placeholder="Tipo" required>-->
                                <select class="form-control" name="tipo" id="tipo">
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Técnico">Técnico</option>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" required>
                            </div>
                        </div>


                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->

                        <div class="modal-footer">
                            <button id="closeEdit" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("Include/footer.php"); ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Clientes.js"></script>
</body>

</html>