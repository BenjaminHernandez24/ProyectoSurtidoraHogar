<!doctype html>
<html lang="en">

<head>
    <?php include("include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?php include("include/navegacion.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- TABLA PROVEEDORES -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button id="altaProveedor" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevo_proveedor">
                                    Agregar Nuevo Proveedor
                                </button>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="tblProveedores" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>Id</th>
                                            <th>Nombre_Empresa</th>
                                            <th>Telefono_Empresa</th>
                                            <th>Nombre_Proveedor</th>
                                            <th>Telefono_Proveedor</th>
                                            <th>Acciones</th>
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


        <!--=====================================
        MODAL AGREGAR NUEVO PROVEEDOR
        ======================================-->
        <div id="nuevo_proveedor" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmProveedor">
                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nom_empresa">Nombre Empresa</label>
                                <input class="form-control" type="text" name="nom_empresa" placeholder="Nombre Empresa" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel_empresa">Telefono Empresa</label>
                                <input class="form-control" type="text" name="tel_empresa" placeholder="Telefono Empresa" required>
                            </div>
                            <div class="mb-3">
                                <label for="nom_prov">Nombre Proveedor</label>
                                <input class="form-control" type="text" name="nom_prov" placeholder="Nombre Proveedor" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel_prov">Telefono Proveedor</label>
                                <input class="form-control" type="text" name="tel_prov" placeholder="Telefono Proveedor" required>
                            </div>
                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                        <div class="modal-footer">
                            <button  id = "cerrar" type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
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

                            <!-- ENTRADA PARA LA DESCRIPCION DE LA CATEGORIA -->
                            <div class="input-group pt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nav-icon fab fa-cuttlefish"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="desCategoria" name="desCategoria" placeholder="Descripción" required>
                            </div>

                        </div>


                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->

                        <div class="modal-footer">
                            <button id="closeEdit" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/proveedores.js"></script>

</body>

</html>