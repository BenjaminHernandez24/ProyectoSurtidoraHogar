<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: Login.php');
}

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename= ManualSurtidoraHogar.pdf");
readfile("Ayuda_Pdf/LaSurtidoraAyuda.pdf");
?>