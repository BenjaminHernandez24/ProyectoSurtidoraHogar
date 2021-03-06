<?php
if (!isset($_SESSION['user'])) {
    session_start();
}
?>

<div class="content-wrapper">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-12">
                <!--=====================================
                Cabezera
                ======================================-->
                
                <div class="card">
                    <div class="card-body">
                        <i class="nav-icon fas fa-sliders-h" style="color:#F29F05; font-size: 30px;"> Ajustes</i>
                    </div>
                </div>
                <!--=====================================
                Formulario
                ======================================-->
                <div class="row row-cols-1 row-cols-md-2 g-4">
                   <?php if ($_SESSION['user'] == "Administrador1" || $_SESSION['user'] == "Administrador2") { ?>
                    <!--=====================================
                    Datos de usuario
                    ======================================-->
                    <form id="frmUsuario">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-user"> Información Usuario</i>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Usuario</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
                                                <input id="usuario" name="usuario" value="<?php echo $_SESSION['user'] ?>" type="text" class="form-control input-lg" placeholder="Usuario" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Nueva Contraseña</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                                                <input id="newpassword" name="newpassword" type="password" class="form-control input-lg" placeholder="Nueva Contraseña" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="nom_empresa">Repetir Contraseña</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                                                <input id="repetirpassword" name="repetirpassword" type="password" class="form-control input-lg" name="repetirpassword" placeholder="Repetir Contraseña" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                            </div>
                        </div>
                    </form>

                        <!--=====================================
                        restauracion
                        ======================================-->
                  
                    <form id="frmRestauracion">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-database"> Restauración</i>
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Crear Copia de Seguridad</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <?php } else if ($_SESSION['user'] == "Empleado") { ?>
                        <!--=====================================
                    Datos de usuario
                    ======================================-->
                    <form id="frmUsuario">
                        <div class="col">
                            <div class="card">
                                <div class="card-header" style="background-color:#84b6f4; color:white; font-size: 20px;">
                                    <i class="fas fa-user"> Información Usuario</i>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Usuario</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
                                                <input id="usuario" name="usuario" value="<?php echo $_SESSION['user'] ?>" type="text" class="form-control input-lg" placeholder="Usuario" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Nueva Contraseña</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                                                <input id="newpassword" name="newpassword" type="password" class="form-control input-lg" placeholder="Nueva Contraseña" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="nom_empresa">Repetir Contraseña</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                                                <input id="repetirpassword" name="repetirpassword" type="password" class="form-control input-lg" name="repetirpassword" placeholder="Repetir Contraseña" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <?php } ?>
                 </div>   <!--========== Termina class de todo =============-->
                  
            </div>
           


        </div>
    </div>
</div>