        <!--=====================================
        MODAL AGREGAR NUEVO PROVEEDOR
        ======================================-->
        <div id="nuevo_proveedor" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmProveedor">
                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nom_empresa">Nombre Empresa</label>
                                <input class="form-control" type="text" name="nom_empresa" placeholder="Nombre Empresa" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel_empresa">Teléfono Empresa</label>
                                <input class="form-control" type="number" name="tel_empresa" placeholder="Teléfono Empresa" required>
                            </div>
                            <div class="mb-3">
                                <label for="nom_prov">Nombre Proveedor</label>
                                <input class="form-control" type="text" name="nom_prov" placeholder="Nombre Proveedor" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel_prov">Teléfono Proveedor</label>
                                <input class="form-control" type="number" name="tel_prov" placeholder="Teléfono Proveedor" required>
                            </div>
                            <div class="mb-3">
                                <label for="num_cuenta">Número de Cuenta</label>
                                <input class="form-control" type="number" name="num_cuenta" placeholder="Número de Cuenta" required>
                            </div>
                            <div class="mb-3">
                                <label for="nom_banco">Banco</label>
                                <input class="form-control" type="text" name="nom_banco" placeholder="Banco" required>
                            </div>
                            <div class="mb-3">
                                <label for="clave_interbancaria">Clave Interbancaria</label>
                                <input class="form-control" type="number" name="clave_interbancaria" placeholder="Clave Interbancaria" required>
                            </div>
                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>