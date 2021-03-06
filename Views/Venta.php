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

    <div class="wrapper" style="width:1349px;">
        <?php include("include/navegacion.php"); ?>

        <!--Estructura modelo venta -->
        <?php include("FormulariosVentas/FrmVenta.php"); ?>
        <?php include("FormulariosVentas/FrmAgregarCliente.php"); ?>
        <?php include("FormulariosVentas/FrmAgregarNuevoCliente.php"); ?>
        <?php include("FormulariosVentas/FrmEditarVenta.php"); ?>
        <?php include('FormulariosVentas/FrmVentaCambio.php'); ?>
        <?php include("Include/footer.php") ?>
    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <?php include("Include/tabla.php"); ?>
    <script src="dist/js/pages/Ventas.js"></script>
    <script src="dist/js/pages/Venta_Impresiones.js"></script>
    <script src="dist/js/pages/CambioVenta.js"></script>

</body>

</html>