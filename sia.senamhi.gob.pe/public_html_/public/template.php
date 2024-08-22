<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=UTF8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

    <title>SISTEMA DE INFORMACIÓN AGROMETEOROLÓGICA | SIA</title>

    <!-- Fonts -->
    <link href="https://static.electricitymap.org/public_web/css/EuclidTriangleFont.css" rel="stylesheet">
    <link href="https://static.electricitymap.org/public_web/css/OpenSansFont.css" rel="stylesheet">
    <link href="https://static.electricitymap.org/public_web/css/MaterialIcons.css" rel="stylesheet">

    <!-- Leaflet Library -->
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet/1.5.1/leaflet.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MousePosition/L.Control.MousePosition.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MagnifyingGlass/leaflet.magnifyingglass.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-GroupedLayerControl/leaflet.groupedlayercontrol.min.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ZoomHome/leaflet.zoomhome.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-BoxZoom/leaflet-control-boxzoom.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-Fullscreen/Leaflet.fullscreen.css" rel="stylesheet" />


    <link rel="stylesheet" type="text/css" href="public/assets/dist/css/main.css">

    <?php Content::view('css-template') ?>

    <link rel="stylesheet" type="text/css" href="resources/css/custom.css">
</head>

<body>
    <?php
    $pg = isset($_GET['p']) ? $_GET['p'] : 'inicio';
    ?>

    <?php if ($pg == 'inicio') : ?>
        <div class="outer-loader">
            <div class="inner-loader-img">
            </div>
            <div class="lds-dual-ring"></div>
        </div>
    <?php endif; ?>
    <main>
        <!-- HEADER -->
        <?php Content::view('header') ?>

        <?php Content::view('panel') ?>

        <?php Content::view('modal-menu') ?>
        <?php if ($pg == 'inicio') : ?>
            <div id="inicioPanel" class="modalServices_menu">
                <div class="modal">
                    <div class="body">
                        <div class="menu">
                            <h2>Sistema de Información Agrometeorológica</h2>
                            <p>
                                El siguiente visor muestra un conjunto de servicios presentados en mapas proveniente de la red de observación meteorológica del SENAMHI.
                            </p>
                            <a href="?p=evapotranspiracion-1ra">
                                <button type="button" class="ant-btn ant-btn-primary">
                                    <span>Ingresar</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php Content::view('movil-tabs') ?>
    </main>
</body>

<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/jquery/jquery-3.2.1.min.js"></script>
<!-- Leaflet Library -->
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet/1.5.1/leaflet.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MousePosition/L.Control.MousePosition.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MagnifyingGlass/leaflet.magnifyingglass.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ControlCustom/Leaflet.Control.Custom.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-GroupedLayerControl/leaflet.groupedlayercontrol.min.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ZoomHome/leaflet.zoomhome.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-BoxZoom/leaflet-control-boxzoom.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-omnivore/leaflet-omnivore.min.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-Fullscreen/Leaflet.fullscreen.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-wms/leaflet.wms.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!--
<script src="https://rowanwins.github.io/leaflet-easyPrint/dist/bundle.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://unpkg.com/leaflet-simple-map-screenshoter"></script>
-->
<script src="https://unpkg.com/file-saver/dist/FileSaver.js"></script>
<script src="public/assets/dist/js/maco-screenshoter.js"></script>


<script src="public/assets/dist/js/main.js"></script>

<?php Content::view('js-template') ?>

<script src="resources/js/custom.js"></script>