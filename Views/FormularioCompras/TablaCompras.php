<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
            <!-- TABLA COMPRAS -->
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-shopping-bag" style="color:#F29F05; font-size: 30px;"> Compras </i>
                                </div>  
                            </div>
                        <div class="card">
                        <div class="card-header">
                                <button id="alta_compra" class="btn btn-outline-primary" data-toggle="modal" data-target="#nueva_compra">
                                    Agregar Compra
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tab_compras" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>ID compra </th>
                                            <th>Proveedor</th>
                                            <th>Producto</th>
                                            <th>Número de Piezas</th>
                                            <th>Precio unitario</th>
                                            <th>Subtotal</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
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
            <!-- /. TABLA COMPRAS -->
        </div>
         <!-- ends content-wrapper -->