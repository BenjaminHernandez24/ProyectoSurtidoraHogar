<!------------------------ REGISTRO  DE PRODUCTOS ------------------------->
<div id="nuevo_producto" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nom_producto">Nombre Producto</label>
                                <input class="form-control" type="text" name="nom_producto" placeholder="Nombre producto" required>
                            </div>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                        <label for="tipo">Tipo Producto</label>
                        <select class="form-control" name="tipo_producto" id="tipo_producto">
                           <option value="default">Selecciona un tipo</option>
                           </select>
                           </div>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                        <label for="marca">Marca Producto</label>
                        <select class="form-control" name="marca_producto" id="marca_producto">
                           <option value="default">Selecciona una Marca</option>
                           </select>
                           </div>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="precio_pub">Precio Público</label>
                                <input class="form-control" type="text" name="precio_pub" placeholder="Precio" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">  Registrar   </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>