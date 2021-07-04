<?php
session_start();
<<<<<<< HEAD
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
}
?>
=======
if (!isset($_SESSION['user']) ) {
    header('Location: Login.php');
}

?> 
>>>>>>> 4695ae7297e0031dc5d69547c474570678ca63e4
<!doctype html>
<html lang="en">

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
        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Ventas.js"></script>

</body>

</html>