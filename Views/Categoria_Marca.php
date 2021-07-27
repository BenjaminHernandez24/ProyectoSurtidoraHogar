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

    <div class="wrapper" style="width:1349px;">

        <?php include("include/navegacion.php"); ?>
        <!--------------- TABLA  MARCA DE PRODUCTO------------------->
               <?php include("FormularioMarca/TablaMarca.php"); ?>
        <!---------------- REGISTRO MARCA DE PRODUCTO---------------->
             <?php include("FormularioMarca/FrmRegistroMarca.php"); ?>
        <!---------------- EDITAR MARCA PRODUCTO -------------------->
        <?php include("FormularioMarca/FrmEditarMarca.php"); ?>
        <!---------------- Footer---------------->
        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <?php include("Include/tabla.php"); ?>
    <script src="dist/js/pages/Categoria_Marca.js"></script>

</body>
</html>