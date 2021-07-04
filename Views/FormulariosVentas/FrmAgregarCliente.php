<!--=====================================
        MODAL AGREGAR NUEVO CLIENTE
        ======================================-->
<div id="modalcliente" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" id="frmClientes">
                <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#nuevo_cliente">
                                Agregar Nuevo Cliente
                            </button>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table class="table table-light" id="tblClientes" style="text-align: center;">
                                <thead class="thead-light">
                                    <tr class="table table-dark">
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Telefono</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                <div class="modal-footer">
                    <button id="closeCerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>