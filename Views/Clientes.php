<!doctype html>
<html lang="en">

<head>
    <?php include("Include/cabezera.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

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