<!--==================================  MODAL EDITAR PRODUCTO-PAQUETE ===================================-->
<div id="editar_cantidad_precio" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="frm_editar_paquete">
                <!--================================= HEADER DEL MODAL =====================================-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--================== CUERPO DEL MODAL ===================== -->
                <div class="modal-body">    
                    <label for="cantidad">Cantidad</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                        <input id="cantidadEditar" name="cantidadEditar" type="number" class="form-control input-lg" min="1" pattern="^[0-9]+" placeholder="0" required>
                    </div>
                    <label for="precio">Total</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-clipboard"></i></span>
                        <input id="total_editar" name="total_editar" type="number" class="form-control input-lg" total="" placeholder="0" readonly required>
                    </div>
                </div>
                <!--========================= PIE DEL MODAL ===========================-->
                <div class="modal-footer">
                    <button id="CerrarEditar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambio</button>
                </div>
            </form>
        </div>
    </div>
</div>