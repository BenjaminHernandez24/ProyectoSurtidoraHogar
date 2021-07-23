<?php
session_start();
if (!isset($_SESSION['user'])) {
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
    <?php include("Include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper" style="width:1349px;">

        <?php include("Include/navegacion.php"); ?>

        <!-- Tabla Clientes -->
        <?php include("FormulariosClientes/TablaFrmClientes.php"); ?>

        <!-- Formulario Agregar Cliente -->
        <?php include("FormulariosClientes/FrmAgregar.php"); ?>

        <!-- Formulario Editar Cliente -->   
        <?php include("FormulariosClientes/FrmEditar.php"); ?>
        
        <?php include("Include/footer.php"); ?>

    </div>
    <!-- ./wrapper -->

    <?php include("Include/scripts.php"); ?>
    <script src="dist/js/pages/Clientes.js"></script>
</body>

</html>