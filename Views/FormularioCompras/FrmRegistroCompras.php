<!------------------------ REGISTRO DE COMPRAS ------------------------->
<div id="nueva_compra" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_compras">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <i class="fas fa-shopping-bag" style="color:#F29F05; font-size: 30px;"> Nueva Compra</i>
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
                         <label for="nom_producto">Buscar Producto</label>
                         <div class="input-group mb-3">
                         <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
                         <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style> 
                        </div>

                        <label for="nom_producto">Producto</label>
                        <input id="nombre_producto" name="nombre_producto" autocomplete="off" class="form-control mb-3" type="text" placeholder="Nombre del Producto" readonly required>
                    </div>
                        <div class="modal-body">
                                <label for="piezas">Número de piezas</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-boxes"></i></span>
                                <input class="form-control"  autocomplete="off" type="number" id="piezas" name="piezas" placeholder="Introduzca la cantidad" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="precio_unit">Precio Unitario</label>
                                <div class="input-group mb-3">   
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-money-check-alt"></i></i></span>
                                <input class="form-control"  autocomplete="off" type="number" step="any" id="precio_unit" name="precio_unit" placeholder="Introduzca el precio" required>
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