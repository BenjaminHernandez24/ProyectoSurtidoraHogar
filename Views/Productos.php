<?php
session_start();
if (!isset($_SESSION['user']) ) {
   header('Location: Login.php');
}
if (
  $_SESSION['user'] != "Administrador1" &&
  $_SESSION['user'] != "Administrador2")
{
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
        <!----------------- TABLA DE PRODUCTOS ------------------>
               <?php include("FormularioProductos/TablaProductos.php"); ?>
        <!---------------- REGISTRO DE PRODUCTOS ---------------->
             <?php include("FormularioProductos/FrmRegistroProductos.php"); ?>
        <!---------------- EDITAR LOS PRODUCTOS ----------------->
        <?php include("FormularioProductos/FrmEditarProductos.php"); ?>
        <!---------------------- FOOTER ------------------------->
        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->
    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Productos.js"></script>

    </body>
</html>