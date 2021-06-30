<!------------------------ REGISTRO MARCA DE PRODUCTO------------------------->
<div id="nueva_marca" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_marca_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Marca Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="des_marca">Descripción de marca Producto</label>
                                <input class="form-control" type="text" name="des_marca" placeholder="Descripción de marca" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>