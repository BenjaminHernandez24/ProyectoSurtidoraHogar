<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "include/cabezera.php";?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php include "include/navegacion.php"?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <embed height="600px" id="AyudaPdf" src="Ayuda_Pdf/LaSurtidoraAyuda.pdf#toolbar=1&navpanes=1&scrollbar=1&zoom=128" style="toolbar-color: rgb(90, 45, 30);" type="application/pdf" width="100%">
                        </embed>
                    </div>
                </section>
            </div>
            <!-- /.container-fluid -->
            <!-- /.content -->
        </div>
        <?php include "include/footer.php"?>
        <!-- ./wrapper -->
        <?php include "Include/scripts.php";?>
    </body>
</html>