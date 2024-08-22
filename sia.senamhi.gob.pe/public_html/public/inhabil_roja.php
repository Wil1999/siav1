<?php
                $directory = "../alertas/";
                foreach (glob($directory . "*ROJA*") as $filename) {
                    $new_filename = str_replace("HABIL-ROJA", "INHABIL-ROJA", $filename);
                    rename($filename, $new_filename);
                }
header("Location: http://sia.senamhi.gob.pe/public/alerta_registro.php");
?>
