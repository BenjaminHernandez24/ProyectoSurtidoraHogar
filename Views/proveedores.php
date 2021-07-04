<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: Login.php');
}
if (
    $_SESSION['user'] != "Administrador1" &&
    $_SESSION['user'] != "Administrador2" )  {
    header('Location: Login.php');
  }
?> 
<!doctype html>
<html lang="en">

<head>
    <?php include("include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?php include("include/navegacion.php"); ?>

        <!-- Tabla Clientes -->
        <?php include("FormulariosProveedores/TablaFrmProveedores.php"); ?>

        <!-- Formulario Agregar Proveedores -->
        <?php include("FormulariosProveedores/FrmAgregar.php"); ?>

        <!-- Formulario Editar Cliente -->
        <?php include("FormulariosProveedores/FrmEditar.php"); ?>

        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/proveedores.js"></script>

</body>

</html>