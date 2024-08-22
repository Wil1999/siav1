<!DOCTYPE html>
<html lang="es">

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<style>


input[type=file] {
    display: none;
}

.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #2196f3;
    color: white;
    border-radius: 4px;
}

.custom-file-upload:hover {
    background-color: #3e8e41;
}


/* Estilo para la tabla */
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #2196f3;
    color: white;
}

tr:hover {background-color: #f5f5f5;}

/* Estilo para el formulario */
form {
    width: 50%;
    margin: 20px auto;
}

label {
    display: block;
    margin-bottom: 8px;
}

input[type=file] {
    display: block;
    margin-top: 8px;
}

input[type=submit] {
    margin-top: 16px;
    background-color: #2196f3;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=text] {
    margin-top: 16px;
    background-color: #2196f3;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #3e8e41;
}

/* Estilo para los mensajes de error y éxito */
.error, .success {
    border: 1px solid;
    margin: 10px 0px;
    padding: 15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 10px center;
    font-weight: bold;
}

.error {
    color: #D8000C;
    background-color: #FFD2D2;
    background-image: url('https://i.imgur.com/GnyDvKN.png');
}

.success {
    color: #4F8A10;
    background-color: #DFF2BF;
   /* background-image: url('https://i.imgur.com/Q9BGTNv.png'); */
}

td, th {
  font-size: 16px;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}
</style>
</head>

<body>
<!-- Creamos el formulario para subir archivos PDF -->

<form action="" method="post" enctype="multipart/form-data">
<label for="pdf_file"  class="custom-file-upload">Token :</label>
        <input type="text" name="token" id="token">
<label for="pdf_file" class="custom-file-upload">    <input type="file" name="pdf_file" id="pdf_file" class="custom-file-upload">  </label>
    <input type="submit" name="submit" value="Subir archivo">
</form>
<?php

if(isset($_POST['submit'])) {
    
    $password = $_POST['token'];
    if($password != "Hynhduw746hmm883JYYJ") {
        echo "<div class='error'>Token incorrecto</div>";
    } else {
    // Obtenemos el nombre y la extensión del archivo
    $file_name = $_FILES['pdf_file']['name'];
    
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    // Validamos si el archivo es PDF
    if(strtolower($file_extension) == "pdf") {
        // Validamos la cabecera del archivo para confirmar que es PDF
        $file = $_FILES['pdf_file']['tmp_name'];
        $handle = fopen($file, "r");
        $line = fgets($handle);
        fclose($handle);

        if(preg_match('/%PDF-/', $line)) {

            // Agregamos el prefijo HABIL_ROJA al nombre del archivo si contiene la palabra ROJA en su nombre

            if(strpos($file_name, "ROJA") !== FALSE) { 
                $file_name = "HABIL-".$file_name;
                $directory = "../alertas/";
                foreach (glob($directory . "HABIL-ROJA*") as $filename) {
                    $new_filename = str_replace("HABIL-ROJA", "INHABIL-ROJA", $filename);
                    rename($filename, $new_filename);
                }

            }
            
            if(strpos($file_name, "AMARILLA") !== FALSE) { 
                $file_name = "HABIL-".$file_name;
                $directory = "../alertas/";
                foreach (glob($directory . "HABIL-AMARILLA*") as $filename) {
                    $new_filename = str_replace("HABIL-AMARILLA", "INHABIL-AMARILLA", $filename);
                    rename($filename, $new_filename);
                }

            }

            if(strpos($file_name, "VERDE") !== FALSE) { 
                $file_name = "HABIL-".$file_name;
                $directory = "../alertas/";
                foreach (glob($directory . "HABIL-VERDE*") as $filename) {
                    $new_filename = str_replace("HABIL-VERDE", "INHABIL-VERDE", $filename);
                    rename($filename, $new_filename);
                }

            }

        	
//		echo "<br> ruta "."../alertas/".$file_name;
//		echo "<br> tmp_name ". $_FILES['pdf_file']['tmp_name'];
            // Movemos el archivo al directorio deseado
//           $x= move_uploaded_file($_FILES['pdf_file']['tmp_name'], "../alertas/".$file_name);
           $x= move_uploaded_file($_FILES['pdf_file']['tmp_name'], '/var/www/html/sia.senamhi.gob.pe/public_html/alertas/'.$file_name);
//		echo "<br> mueve  ".$x;
            // Mostramos un mensaje de exito
            echo "<div class='success'><p>El archivo PDF se ha subido correctamente.</p></div>";

        } else {
            echo "<p>El archivo subido no es un PDF válido.</p>";
        }
    } else {
        echo "<p>Sólo se permiten archivos PDF.</p>";
    }
}
}

?>



<?php

// Mostramos la tabla de archivos PDF existentes
echo "<table>";
echo "<tr><th>Alertas</th><th>Ver</th></tr>";

// Obtenemos todos los archivos PDF en el directorio y los mostramos en la tabla
$files = glob("../alertas/*.pdf");
foreach($files as $file) {
    echo "<tr><td>" . basename($file) . "</td>";
    echo "<td><a href='../alertas/" . basename($file) . "' target='_blank'><i class='fa fa-eye'></i></a></td> </tr> ";
}
echo "</table>";
?>

<a href=inhabil_amarilla.php>Deshabilitar Alertas Amarillas</a> | 
<a href=inhabil_verde.php>Deshabilitar Alertas Verdes</a> |
<a href=inhabil_roja.php>Deshabilitar Alertas Rojas</a>

</body>

</html>
