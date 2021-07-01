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

        <!--------------- TABLA TIPO DE PRODUCTO------------------->
           <?php include("FormularioTipo/TablaTipo.php"); ?>
        <!------------- REGISTRO TIPO DE PRODUCTO------------------>
           <?php include("FormularioTipo/FrmRegistroTipo.php"); ?>
        <!-------------- EDITAR TIPO PRODUCTO --------------------->
          <?php include("FormularioTipo/FrmEditarTipo.php"); ?>
        <!-------------- FOOTER --------------------->
            <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Categoria_Tipo.js"></script>

</body>
</html>