<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
            <!----------------- TABLA DE PRODUCTOS ------------------>
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                                <div class="card-body">
                                    <i class="nav-icon fas fa-box" style="color:#F29F05; font-size: 30px;"> Productos</i>
                                </div>
                            </div>
                        <div class="card">
                            <div class="card-header">
                                <button id="alta_producto" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevo_producto">
                                    Agregar Producto
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="TablaProductos" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>ID</th>
                                            <th>Nombre de Producto</th>
                                            <th>Precio público</th>
                                            <th>Tipo de Producto</th>
                                            <th>Marca de Producto</th>
                                            <th>Estado</th>
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
            <!-- /. TABLA PRODUCTOS -->
        </div>
         <!-- ends content-wrapper -->