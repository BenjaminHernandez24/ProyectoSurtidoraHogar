        <!--=====================================
        MODAL EDITAR PROVEEDOR
        ======================================-->
        <div id="editar_proveedor" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmEditarProveedor">
                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                        <div class="modal-header">
                        <i class="nav-icon fas fa-truck" style="color:#F29F05; font-size: 30px;"> Editar Proveedor</i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <label for="nom_empresa">Nombre Empresa</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-building"></i></span>
                                <input class="form-control" type="text" id="nom_empresa" name="nom_empresa" placeholder="Nombre Empresa" required>
                            </div>
                            <label for="tel_empresa">Teléfono Empresa</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                <input class="form-control" type="number" id="tel_empresa" name="tel_empresa" placeholder="Teléfono Empresa" required>
                            </div>
                            <label for="nom_prov">Nombre Proveedor</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user-tie"></i></span>
                                <input class="form-control" type="text" id="nom_prov" name="nom_prov" placeholder="Nombre Proveedor" required>
                            </div>
                            <label for="tel_prov">Teléfono Proveedor</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                <input class="form-control" type="number" id="tel_prov" name="tel_prov" placeholder="Teléfono Proveedor" required>
                            </div>
                            <label for="num_cuenta">Número de Cuenta</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-money-check"></i></span>
                                <input class="form-control" type="number" id="num_cuenta" name="num_cuenta" placeholder="Número de Cuenta" required>
                            </div>
                            <label for="nom_banco">Banco</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-hotel"></i></span>
                                <input class="form-control" type="text" id="nom_banco" name="nom_banco" placeholder="Banco" required>
                            </div>
                            <label for="clave_interbancaria">Clave Interbancaria</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-money-check-alt"></i></span>
                                <input class="form-control" type="number" id="clave_interbancaria" name="clave_interbancaria" placeholder="Clave Interbancaria" required>
                            </div>
                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                        <div class="modal-footer">
                            <button id="cerrarEditar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>