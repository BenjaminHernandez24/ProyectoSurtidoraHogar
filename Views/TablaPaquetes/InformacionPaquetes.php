<div id="informacionPaquete" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-box-open" style="color:#F29F05; font-size: 30px;"> Información Paquete</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container-fluid pt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <form id="frmDatosPaqueteEditar">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                            <i class="fas fa-th-large">   Selecciona Productos</i>
                                        </div>
                                        <div class="card-body">
                                            <label for="nom_paquete">Nombre de paquete</label>
                                            <div class="input-group mb-3">
                                                <input id="nom_paquete" name="nom_paquete" type="text" class="form-control" placeholder="Nombre del Paquete" aria-label="Recipient's username" >
                                            </div>

                                            <label for="nom_empresa">Buscar Producto</label>
                                            <div class="input-group mb-3">
                                                <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2" require>
                                            </div>

                                            <label for="nom_producto">Producto</label>
                                            <input id="nombre_producto" name="nombre_producto" autocomplete="off" class="form-control mb-3" type="text" placeholder="Nombre del Producto" readonly required>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Precio Unitario Venta</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                                        <input id="precio" name="precio" type="number" step="any" class="form-control input-lg" total="" placeholder="0" readonly required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="nom_empresa">Cantidad</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                                        <input id="cantidad" type="number" min="1" pattern="^[0-9]+" class="form-control input-lg" name="cantidad" total="" placeholder="0"  required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="frmDetallePaqueteEditar">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                            <i class="fas fa-archive">   Detalles de Paquete</i>
                                        </div>
                                        <div class="card-body">
                                            <label for="tipo">Tipo Paquete</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                                                <select class="form-control" name="tipo_paquete" id="tipo_paquete">
                                                    <option value="default">Selecciona un tipo</option>
                                                </select>
                                            </div>

                                            <label for="marca">Marca  Paquete</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"> <i class="fas fa-tag"></i></span>
                                                <select class="form-control" name="marca_paquete" id="marca_paquete">
                                                    <option value="default">Selecciona una Marca</option>
                                                </select>
                                            </div>

                                            <label for="nom_empresa">Subtotal</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                <input id="subtotal" name="subtotal" style="font-size: 35px;" type="number" step="any" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                            </div>

                                            <label for="nom_empresa">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                <input id="total" name="total" style="font-size: 35px;" type="number" min="1" step="any" class="form-control input-lg" total="" placeholder="0"  required>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Guardar paquete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                <i class="fas fa-cart-plus"> Lista de productos </i>
                            </div>
                            <div class="card-body">
                                <table id="tablapqtEditar" class="table table-light">
                                    <thead class="thead-light">
                                        <tr class="table table-dark">
                                            <th>ID Producto</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>