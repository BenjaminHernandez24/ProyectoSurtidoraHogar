<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
            <!-- Tabla Inventario -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-dolly-flatbed" style="color:#F29F05; font-size: 30px;"> Inventario </i>
                                </div> 
                            </div>
                        <div class="card">
                        <div class="card-header">
                                <button id="alta_producto_inv" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevo_producto_inv">
                                    Agregar Producto
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tab_inventario" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>ID Inventario</th>
                                            <th>Producto</th>
                                            <th>Estatus aceptable</th>
                                            <th>Estatus Alerta</th>
                                            <th>Stock</th>
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
            <!-- /. TABLA INVENTARIO -->
        </div>
         <!-- ends content-wrapper -->