<?php

function isValidPdfFile($fileName) {
    $pattern = "/^[\w-]+-\d{8}\.pdf$/";
    return preg_match($pattern, $fileName) === 1;
  }


$dir =  getcwd();
$files = scandir($dir);

echo "<table>";
echo "<tr>";
echo "<th>Alertas</th>";
echo "</tr>";

foreach ($files as $file) {
  if ($file != "." && $file != ".." && isValidPdfFile($file)) {
    echo "<tr>";
    echo "<td>" . $file . "</td>";
    echo "</tr>";
  }
}

echo "</table>"; 
