<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['url']) && !empty($_POST['url'])) {
    $url = $_POST['url'];
} else {
    exit();
}


//$url = 'https://idesep.senamhi.gob.pe/geoserver/g_05_01/wms?service=WMS&request=GetFeatureInfo&version=1.1.1&layers=05_01_001_03_001_512_2021_00_00&styles=&format=image%2Fpng&transparent=true&cql_filter=id%20IN%20(%2705_01_001_03_001_512_2021_00_00.7%27)&info_format=application%2Fjson&tiled=true&detectRetina=true&width=1329&height=937&srs=EPSG%3A3857&bbox=-9972280.458197236%2C-2174480.5806566933%2C-6721566.51928526%2C117407.27544603069&query_layers=05_01_001_03_001_512_2021_00_00&X=672&Y=345';

$features = json_decode(@file_get_contents($url), true);

/*echo "<pre>", print_r($features), "</pre>";*/

/*exit();*/

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
        $jsonFeatures['nivel'] = $arrayFeatures['nivel'];
        $jsonFeatures['area'] = $arrayFeatures['area'];
        $jsonFeatures['perimetro'] = $arrayFeatures['perimetro'];
        $jsonFeatures['fecha'] = $arrayFeatures['fecha'];
    }
}

echo json_encode($jsonFeatures);
