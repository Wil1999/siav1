 
<?php

function postApi($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$url = "https://www.senamhi.gob.pe/include/_estudios-e-investigaciones.php";
$data = array();
$response = postApi($url, $data);
$data = json_decode($response, true);
//var_dump(json_encode($data));

$filtered_data = array();
foreach($data['data'] as $d) {
    
  if($d['tag'] == 'Agrometeorologia') { 
    $filtered_data[] = $d;
  }
}
?>

<script>
$(document).ready(function() {
      $('#data_table1').DataTable({
        data: <?php echo json_encode($filtered_data); ?>,
        columns: [
          { data: "fecha" },
          { data: "tipo" },
          { data: "link" },
        ]
      });
    });
    </script>
<table id="data_table1">
      <thead>
        <tr>
          <th> Fecha    </th>
          <th>Tipo</th>
          <th>Link</th>
        </tr>
      </thead>
    </table>
