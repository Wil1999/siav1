<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['url']) && !empty($_POST['url'])) {
    $url = $_POST['url'];
} else {
    exit();
}

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
        $jsonFeatures['rango'] = $arrayFeatures['rango'];
    }
}

echo json_encode($jsonFeatures);
