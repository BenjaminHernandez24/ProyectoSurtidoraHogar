<?php
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename= ManualSurtidoraHogar.pdf");
readfile("Ayuda_Pdf/LaSurtidoraAyuda.pdf");
?>