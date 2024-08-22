<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


if (isset($_POST['url']) && !empty($_POST['url'])) {
    $url = $_POST['url'];
} else {
    exit();
}
/*
$url = 'https://idesep.senamhi.gob.pe/geoserver/g_11_03/wms?&service=WMS&request=GetMap&layers=11_03_001_03_001_531_0000_00_00&styles=&format=image%2Fpng&transparent=true&version=1.1.1&id=11_03_001_03_001_531_0000_00_00&cql_filter=1%3D1&info_format=application%2Fjson&tiled=true&width=256&height=256&srs=EPSG%3A3857&bbox=-8766409.899970295,-1252344.2714243263,-8140237.764258132,-626172.1357121632';
*/
$features = @file_get_contents($url);

$base64 = base64_encode($features);

$jsonFeatures = null;

if (isset($base64)) {
    $jsonFeatures['base64'] = $base64;
    $jsonFeatures['url'] = $url;
}

echo json_encode($jsonFeatures);
