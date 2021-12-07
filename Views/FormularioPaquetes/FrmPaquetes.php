<!-- PAQUETES -->
<div class="content-wrapper">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-12">
    <!--=================================  Cabezera ===================================-->
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-archive" style="color:#F29F05; font-size: 30px;">  Paquetes</i>
                         <button class="col-md-2 float-right btn btn-outline-primary" type="button" id="EditarVenta"><font size="4">Ver paquetes</font></button>
                    </div>
                </div>
                <!--=====================================
                Formulario
                ======================================-->
                <div class="row row-cols-1 row-cols-md-2 g-4">

        <!--====================== Datos del producto para paquete =================================-->
                    <form id="frmDatosPaquete">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-th-large">   Selecciona Productos</i>
                                </div>
                                <div class="card-body">
                                    <label for="nom_empresa">Buscar Producto</label>
                                    <div class="input-group mb-3">
                                        <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    </div>

                                    <label for="nom_producto">Producto</label>
                                    <input id="nombre_producto" name="nombre_producto" autocomplete="off" class="form-control mb-3" type="text" placeholder="Nombre del Producto" readonly required>

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Precio Unitario Venta</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                                <input id="precio" name="precio" type="number" step="any" class="form-control input-lg" total="" placeholder="0"  required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="nom_empresa">Cantidad</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                                <input id="cantidad" type="number" class="form-control input-lg" name="cantidad" total="" placeholder="0"  required>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-body">
                                        <label for="nom_empresa">Subtotal</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                <input id="subtotal" name="subtotal" style="font-size: 40px;" type="number" step="any" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
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
                    <!--=====================================
                Datos del paquete
                ======================================-->
                    <form id="frmDetallePaquete">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-archive">   Detalles de Paquete</i>
                                </div>
                                <div class="modal-body">
                                <label for="tipo">Tipo Paquete</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                                    <select class="form-control" name="tipo_paquete" id="tipo_paquete">
                                <option value="default">Selecciona un tipo</option>
                              </select>
                             </div>
                          </div>
                                <div class="modal-body">
                                <label for="marca">Marca  Paquete</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="addon-wrapping"> <i class="fas fa-tag"></i></span>
                                    <select class="form-control" name="marca_paquete" id="marca_paquete">
                                    <option value="default">Selecciona una Marca</option>
                                </select>
                               </div>
                            </div>

                                <div class="modal-body">
                                <div class="col">
                                <label for="nom_empresa">Total</label>
                                <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                        <input id="total" name="total" style="font-size: 40px;" type="number" step="any" class="form-control input-lg" total="" placeholder="0"  required>
                                    </div>
                                </div>
                                </div>
                                    <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Guardar paquete</button>
                            </div>
                            </div>
                        </div>
                </div>
                
                <!--=====================================
                Tabla de producto para la venta
                ======================================-->
                <div class="card">
                    <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                        <i class="fas fa-cart-plus"> Lista de productos </i>
                    </div>
                    <div class="card-body">
                        <table id="tablapqt" class="table table-light">
                            <thead class="thead-light">
                                <tr class="table table-dark">
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            </form>
                            <tbody id="tbody">
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>