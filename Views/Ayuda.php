<?php
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename= ManualAyudaSurtidoraHogar.pdf");
readfile("Ayuda_Pdf/LaSurtidoraAyuda.pdf");
?>