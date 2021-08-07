<?php
require_once "../Controllers/EstadisticaController.php";
?>

<!-- TABLA PROVEEDORES -->
<div class="content-wrapper">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-12">
                <!--=====================================
                Cabezera
                ======================================-->
                <div class="card">
                    <div class="card-body">
                        <i class="nav-icon fas fa-truck" style="color:#F29F05; font-size: 30px;"> Ventas</i>
                         <button class="col-md-2 float-right btn btn-outline-primary" type="button" id="EditarVenta"><font size="4">Editar Venta</font></button>
                    </div>
                </div>
                <!--=====================================
                Formulario
                ======================================-->
                <div class="row row-cols-1 row-cols-md-2 g-4">

                    <!--=====================================
                Datos del producto para la venta
                ======================================-->
                    <form id="frmDatosProducto">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-th-large"> Productos</i>
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
                                            <label for="">Precio de Venta</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                                <input id="precio" name="precio" type="number" step="any" class="form-control input-lg" total="" placeholder="0" disabled="" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="nom_empresa">Stock</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                                <input id="stock" type="number" class="form-control input-lg" name="stock" total="" placeholder="0" readonly required>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="nom_empresa">Cantidad</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                        <input id="cantidad" name="cantidad" type="number" class="form-control input-lg" total="" placeholder="0" disabled="" required>
                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>

                            </div>
                        </div>
                    </form>

                    <!--=====================================
                Datos de la venta
                ======================================-->
                    <form id="frmDatosVenta">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-cart-plus"> Venta</i>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nom_empresa">Subtotal</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                <input id="subtotal" name="subtotal" style="font-size: 40px;" type="number" step="any" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="nom_empresa">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                <input id="total" name="total" style="font-size: 40px;" type="number" step="any" class="form-control input-lg" total="" placeholder="0" readonly required>
                                            </div>
                                        </div>

                                    </div>

                                    <label for="nom_empresa">Fecha</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="text" style="font-size: 20px;" value="<?php $ctr = new EstadisticasControlador();
                                                                                            $ctr->obtenerFecha(); ?>" readonly required>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="nom_empresa">Cliente</label>
                                            <div class="input-group mb-3">
                                                <input id="nombre_cliente" name="nombre_cliente" type="text" class="form-control" placeholder="Nombre del Cliente" aria-label="Recipient's username" aria-describedby="button-addon2" readonly>
                                                <button id="buscar_cliente" type="button" name="buscar_cliente" class="btn btn-primary" disabled="">Buscar</button>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="nom_empresa">Agregar Cliente</label>
                                            <div class="input-group mb-3">
                                                <button id="nuevo_cliente" type="button" name="nuevo_cliente" class="btn btn-primary" data-toggle="modal">Nuevo Cliente</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="nom_empresa">Seleccione método de pago</label>
                                            <select class="form-control mb-3" id="nuevoMetodoPago" name="nuevoMetodoPago" disabled="" required>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta Crédito">Tarjeta Crédito</option>
                                                <option value="Tarjeta Débito">Tarjeta Débito</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="nom_empresa">Seleccione una opción</label>
                                            <select class="form-control mb-3" id="generar" name="generar" disabled="" required>
                                                <option value="Ninguno">Ninguno</option>
                                                <option value="Ticket">Ticket</option>
                                                <option value="Factura">Factura</option>
                                                <option value="Ambos">Ambos</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" id="fila_cobro">
                                        <div class="col">
                                            <label>Pago</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                                <input id="cobro" type="number" step="any" class="form-control input-lg" name="cobro" total="" placeholder="0" disabled="">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Cambio</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                                <input id="cambio" type="number" class="form-control input-lg" name="cambio" total="" placeholder="0" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>

                </div>
                </form>
                <!--=====================================
                Tabla de producto para la venta
                ======================================-->
                <div class="card">
                    <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                        <i class="fas fa-cart-plus"> Datos de Venta</i>
                    </div>
                    <div class="card-body">
                        <table id="tblDetalleVenta" class="table table-light">
                            <thead class="thead-light">
                                <tr class="table table-dark">
                                    <th>ID_Inventario</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>