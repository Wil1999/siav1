<?php
                $directory = "../alertas/";
                foreach (glob($directory . "*AMARILLA*") as $filename) {
                    $new_filename = str_replace("HABIL-AMARILLA", "INHABIL-AMARILLA", $filename);
                    rename($filename, $new_filename);
                }
header("Location: http://sia.senamhi.gob.pe/public/alerta_registro.php");
?>
