<!------------------------ EDITAR UNA COMPRA ------------------------->
<div id="editar_compra" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_editar_compras">
                         <!--------------------- HEADER ----------------------->
                        <div class="modal-header">
                            <i class="fas fa-shopping-bag" style="color:#F29F05; font-size: 30px;"> Editar Compra</i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <!----------------------- BODY ----------------------->
                      <div class="modal-body">
                        <label for="proveedor">Proveedor</label>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-truck"></i></span>
                             <select class="form-control" name="proveedor_editar" id="proveedor_editar">
                              <option value="default">Selecciona un proveedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="producto">Producto</label>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                             <select class="form-control" name="producto_editar" id="producto_editar">
                              <option value="default">Selecciona un producto</option>
                            </select>
                        </div>
                    </div>
                        <div class="modal-body">
                                <label for="piezas">N??mero de piezas</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-boxes"></i></span>
                                <input class="form-control"  autocomplete="off" type="number" id="piezas_editar" name="piezas_editar" placeholder="Introduzca la cantidad" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="precio_unit">Precio Unitario</label>
                                <div class="input-group mb-3">   
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-money-check-alt"></i></i></span>
                                <input class="form-control"  autocomplete="off" type="number" step="any" id="precio_unit_editar" name="precio_unit_editar" placeholder="Introduzca el precio" required>
                            </div>
                        </div>
                         <!---------------------- FOOTER ----------------------->
                        <div class="modal-footer">
                            <button id="cerrarEditar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>