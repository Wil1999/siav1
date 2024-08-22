<?php
                $directory = "../alertas/";
                foreach (glob($directory . "*VERDE*") as $filename) {
                    $new_filename = str_replace("HABIL-VERDE", "INHABIL-VERDE", $filename);
                    rename($filename, $new_filename);
                }
header("Location: http://sia.senamhi.gob.pe/public/alerta_registro.php");
?>
