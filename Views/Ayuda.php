<?php
header("Content-type: application/pdf");
session_start();

if (!isset($_SESSION['user'])) {
   header('Location: Login.php');
}

if (
  $_SESSION['user'] != "Administrador1" && 
  $_SESSION['user'] != "Administrador2")
{
  header("Content-Disposition: inline; filename= EmpleadoSurtidoraHogar.pdf");
  readfile("Ayuda_Pdf/LaSurtidoraAyudaEmpleado_1.pdf");
}else{
   header("Content-Disposition: inline; filename= ManualSurtidoraHogar.pdf");
   readfile("Ayuda_Pdf/LaSurtidoraAyudaAdministrador_1.pdf");
}  
?>