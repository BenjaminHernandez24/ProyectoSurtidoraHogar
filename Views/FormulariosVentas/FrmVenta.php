<div class="content-wrapper">

    <section class="container-fluid pt-4">

        <div class="row">

            <!--=====================================
      EL FORMULARIO
      ======================================-->

            <div class="col-lg-5 col-xs-12">

                <div class="box box-success card">

                    <div class="box-header with-border card"></div>

                    <form role="form" method="post" class="formularioVenta">

                        <div class="box-body">

                            <div class="box">


                                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

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

                                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

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
                                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
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


                                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

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

            <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

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

</div>