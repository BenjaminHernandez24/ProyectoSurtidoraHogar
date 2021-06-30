<?php
session_start();
if (!isset($_SESSION['user'])) {
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

        <!--Estructura modelo venta -->
        <?php include("FormulariosVentas/FrmVenta.php"); ?>

        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/proveedores.js"></script>

</body>

</html>
