<!------------------------ REGISTRO DE COMPRAS ------------------------->
<div id="nueva_compra" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_compras">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <!------------------------ BODY ------------------------->
                   <div class="modal-body">
                        <label for="proveedor">Proveedor</label>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-truck"></i></span>
                             <select class="form-control" name="proveedor_registro" id="proveedor_registro">
                              <option value="default">Selecciona un proveedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="producto">Producto</label>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                             <select class="form-control" name="producto_registro" id="producto_registro" onchange="showSelected();">
                              <option value="default">Selecciona un producto</option>
                            </select>
                        </div>
                    </div>
                        <div class="modal-body">
                                <label for="piezas">Número de piezas</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-boxes"></i></span>
                                <input class="form-control"  autocomplete="off" type="number" name="piezas" placeholder="Introduzca la cantidad" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="precio_unit">Precio Unitario</label>
                                <div class="input-group mb-3">   
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-money-check-alt"></i></i></span>
                                <input class="form-control"  autocomplete="off" type="number" name="precio_unit" placeholder="Introduzca el precio" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success"> Registrar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>