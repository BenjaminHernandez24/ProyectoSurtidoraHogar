<?php
session_start();
if(!isset($_SESSION['user']))
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
<html lang="es">
  <head>
    <?php include("include/cabezera.php"); ?>
  </head>
    <body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper" style="width:1349px;">

        <?php include("include/navegacion.php"); ?>
        <!----------------- REGISTRO DE PAQUETES ------------------>
           <?php  include("FormularioPaquetes/FrmPaquetes.php"); ?> 
        <!---------------- VER  PAQUETES ----------------->
        <?php include("FormularioPaquetes/FrmEditarPaquetes.php"); ?>
        
        <!---------------------- FOOTER ------------------------->
        <?php include("Include/footer.php") ?>

    </div>
    <!-- ./wrapper -->
    <?php include("Include/scripts.php"); ?>
    <?php include("Include/tabla.php"); ?>
    <script src="dist/js/pages/Paquetes.js"></script>

    </body>
</html>