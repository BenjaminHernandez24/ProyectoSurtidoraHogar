<!--=====================================
        MODAL AGREGAR NUEVO CLIENTE
        ======================================-->
<div id="modalEditarCantidad" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="frmEditarCantidad">
                <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cantidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                <div class="modal-body">
                    <label for="nom_empresa">Stock</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                        <input id="stockEditar" type="text" class="form-control input-lg" name="stockEditar" total="" placeholder="0" readonly required>
                    </div>
                    <label for="nom_empresa">Cantidad</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                        <input id="cantidadEditar" name="cantidadEditar" type="number" class="form-control input-lg" total="" placeholder="0" required>
                    </div>
                </div>
                <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                <div class="modal-footer">
                    <button id="CerrarEditar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambio</button>
                </div>
            </form>
        </div>
    </div>
</div>