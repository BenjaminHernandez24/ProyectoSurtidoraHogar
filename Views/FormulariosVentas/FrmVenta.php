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
                                            <div class="card-header" style="background-color:#D9CB04; color:white; font-size: 20px;">
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
                                                            <input id="precio" name="precio" type="number" class="form-control input-lg" total="" placeholder="0" disabled="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label for="nom_empresa">Stock</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                                            <input id="stock" type="text" class="form-control input-lg" id="nuevoTotalVenta" name="stock" total="" placeholder="0" readonly required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label for="nom_empresa">Cantidad</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                                                    <input id="cantidad" name="cantidad" type="number" class="form-control input-lg" id="nuevoTotalVenta" total="" placeholder="0" disabled="" required>
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

                                <div class="col">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#D9CB04; color:white; font-size: 20px;">
                                            <i class="fas fa-cart-plus"> Venta</i>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="nom_empresa">Subtotal</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                        <input id="subtotal" name="subtotal" style="font-size: 40px;" type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="nom_empresa">Total</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i style="font-size: 20px;" class="fas fa-dollar-sign"></i></span>
                                                        <input style="font-size: 40px;" type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                                    </div>
                                                </div>

                                            </div>

                                            <label for="nom_empresa">Fecha</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                                                <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                            </div>

                                            <label for="nom_empresa">Cliente</label>
                                            <div class="input-group mb-3">
                                                <input id="nombre_cliente" name="nombre_cliente" type="text" class="form-control" placeholder="Nombre del Cliente" aria-label="Recipient's username" aria-describedby="button-addon2" readonly required>
                                                <button id="buscar_cliente" class="btn btn-primary" data-toggle="modal">Buscar</button>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="nom_empresa">Seleccione método de pago</label>
                                                    <select class="form-control mb-3" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="TC">Tarjeta Crédito</option>
                                                        <option value="TD">Tarjeta Débito</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="nom_empresa">Descuento</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-percentage"></i></span>
                                                        <input id="descuento" type="number" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" disabled="" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer text-right">
                                            <a href="#" class="btn btn-primary">Confirmar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--=====================================
                Tabla de producto para la venta
                ======================================-->
                            <div class="card">
                                <div class="card-header" style="background-color:#D9CB04; color:white; font-size: 20px;">
                                    <i class="fas fa-cart-plus"> Datos de Venta</i>
                                </div>
                                <div class="card-body">
                                    <table id="tblDetalleVenta" class="table table-light">
                                        <thead class="thead-light">
                                            <tr class="table table-dark">
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



            <!-- <div class="content-wrapper">

    <section class="container-fluid pt-4">
        <div class="card">
            <i class="nav-icon fas fa-truck" style="color:#F29F05; font-size: 40px;"> Ventas</i>
        </div>
        <div class="row">
            <=====================================
      EL FORMULARIO
      ======================================

            <div class="col-lg-5 col-xs-12">
                <div class="box box-success card">

                    <div class="box-header with-border card"></div>

                    <form role="form" method="post" class="formularioVenta">

                        <div class="box-body">

                            <div class="box">


                                <!=====================================
                ENTRADA DEL CLIENTE
                ======================================-

                                <div class="card-body">

                                    <div class="input-group">

                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>

                                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                                            <option value="">Seleccionar cliente</option>
                                            <option value="1">Noe</option>
                                            <option value="2">Benjamin</option>
                                            <option value="3">Evelyn</option>

                                        </select>

                                        <span class="input-group-addon"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                                    </div>

                                </div>

                                <!=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================->

                                <div class="row">

                                    <div class="col-xs-8 pull-right card-body form-group row">

                                        <table class="table">

                                            <thead>

                                                <tr>
                                                    <th></th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td style="width: 0%">

                                                        <div class="input-group">
                                                            <button class="btn btn-danger" type="button">X</button>
                                                        </div>

                                                    </td>
                                                    <td style="width: 60%">

                                                        <div class="input-group">

                                                            <input type="Text" class="form-control input-lg" min="Producto" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" value="Tornillo" readonly required>
                                                        </div>

                                                    </td>

                                                    <td style="width: 10%">

                                                        <div class="input-group">
                                                            <input type="Number" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" required>
                                                        </div>

                                                    </td>

                                                    <td style="width: 40%">

                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>
                                                            <input type="hidden" name="totalVenta" id="totalVenta">
                                                        </div>

                                                    </td>


                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                                <!-=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-
                                <div class="row">

                                    <div class="col-xs-8 pull-right card-body form-group row">

                                        <table class="table">

                                            <thead>

                                                <tr>
                                                    <th>Descuento</th>
                                                    <th>Total</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td style="width: 50%">

                                                        <div class="input-group">
                                                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-percentage"></i></span>
                                                            <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                                                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                                                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>


                                                        </div>

                                                    </td>

                                                    <td style="width: 50%">

                                                        <div class="input-group">

                                                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>

                                                            <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                                                            <input type="hidden" name="totalVenta" id="totalVenta">


                                                        </div>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>


                                <!-=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================--

                                <div class="card-body">

                                    <div class="col-xs-6" style="padding-right:0px">

                                        <div class="input-group">

                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="TC">Tarjeta Crédito</option>
                                                <option value="TD">Tarjeta Débito</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="cajasMetodoPago"></div>

                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                                </div>

                                <br>

                            </div>

                        </div>

                        <div class="box-footer card-body">

                            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

                        </div>

                    </form>

                </div>

            </div>

            <!-=====================================
      LA TABLA DE PRODUCTOS
      ======================================--

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

                <div class="card">

                    <div class="box-header with-border"></div>

                    <div class="card-body">

                        <table id="tbl" class="table table-light">
                            <thead class="thead-light">
                                <tr class="table table-dark">
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>


            </div>

        </div>

    </section>

</div>



</form>



</div>

</div>

</div> -->