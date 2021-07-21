<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
}

?>
<!doctype html>
<html lang="es">

<head>
    <?php include("include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <?php include("include/navegacion.php"); ?>

        <!--Estructura modelo venta -->
        <?php include("FormulariosVentas/FrmVenta.php"); ?>
        <?php include("FormulariosVentas/FrmAgregarCliente.php"); ?>
        <?php include("FormulariosVentas/FrmAgregarNuevoCliente.php"); ?>
        <?php include("FormulariosVentas/FrmEditarVenta.php"); ?>
        <?php include("Include/footer.php") ?>
    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Ventas.js"></script>

</body>

</html>