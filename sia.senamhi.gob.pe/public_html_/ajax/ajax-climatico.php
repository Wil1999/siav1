<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['url']) && !empty($_POST['url'])) {
    $url = $_POST['url'];
} else {
    exit();
}
//echo "urlx=".$_POST['url'];
$features = json_decode(@file_get_contents($url), true);

$jsonFeatures = null;

if (isset($features['features'][0]['properties']) && isset($features['features'][0]['id'])) {

    $id = $features['features'][0]['id'];

    if (strpos($id, ".")) {
        $id = explode(".", $id);
        $id = trim($id[1]);
    }

    if (count($features['features'][0]['properties'])) {

        $arrayFeatures = $features['features'][0]['properties'];

        $jsonFeatures['id'] = $id;
        $jsonFeatures['codigo'] = $arrayFeatures['codigo'];
        $jsonFeatures['estacion'] = $arrayFeatures['estacion'];
        $jsonFeatures['latitud'] = $arrayFeatures['latitud'];
        $jsonFeatures['longitud'] = $arrayFeatures['longitud'];
        $jsonFeatures['altitud'] = $arrayFeatures['altitud'];
        $jsonFeatures['departamento'] = $arrayFeatures['departamento'];
        $jsonFeatures['provincia'] = $arrayFeatures['provincia'];
        $jsonFeatures['distrito'] = $arrayFeatures['distrito'];
        $jsonFeatures['bajo'] = $arrayFeatures['bajo'];
        $jsonFeatures['normal'] = $arrayFeatures['normal'];
        $jsonFeatures['superior'] = $arrayFeatures['superior'];
        $jsonFeatures['probabilidad'] = $arrayFeatures['probabilidad'];
        $jsonFeatures['escenario'] = $arrayFeatures['escenario'];
        $jsonFeatures['umb_inf_p33'] = $arrayFeatures['umb_inf_p33'];
        $jsonFeatures['umb_inf_p66'] = $arrayFeatures['umb_inf_p66'];
        $jsonFeatures['periodo'] = $arrayFeatures['periodo'];
    }
}

echo json_encode($jsonFeatures);
