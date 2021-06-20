<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- TABLA CLIENTES -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button id="altaCliente" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevo_cliente">
                                    Agregar Nuevo Cliente
                                </button>
                            </div>
                            <!-- /.card-header -->

                                <table class="table table-light" id="tblClientes" style="text-align: center;">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Telefono</th>
                                            <th>Estado</th>
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