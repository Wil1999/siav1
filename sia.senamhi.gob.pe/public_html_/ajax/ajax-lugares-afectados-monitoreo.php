<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../helpers/Format.php';
require_once '../src/UbicacionMonitoreo/UbicacionMonitoreoController.php';
require_once '../src/UbicacionMonitoreo/UbicacionMonitoreo.php';

if (isset($_POST['lugaresAfectados']) && !empty($_POST['lugaresAfectados'])) {
    $lugaresAfectados = $_POST['lugaresAfectados'];
} else {
    exit();
}

$jsonFeatures = array();

$ubicacion_riesgo = new UbicacionMonitoreoController($lugaresAfectados);

$leyendaDepProv = $ubicacion_riesgo->maxLeyenda();

$ubicacionDepProv = $ubicacion_riesgo->ubicacionDepProv();

?>

<a onclick="myFunction()" href="#" style="display:block;right:10px;margin-bottom: 10px;margin-top: 10px;"><span class="icon"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
<span class="title">Gráfico</span>    </a> 

<script>
function myFunction() {
    $('#graphic_dev').show();
}
</script>

<div class="contentBox">
    <h2 class="m-t-0" style="font-size: 14px;
                                color: #555555;
                                line-height: 1.4;
                                text-transform: uppercase;
                                background-color: transparent;">
        
        <span>
            INTENSIDAD :
        </span>
    </h2>
    <div>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeExcesoExtremo'] ?> muy-alto" id="muy-alto" href="#">EXCESO EXTREMO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeExcesoLigero'] ?> alto" id="alto" href="#">EXCESO LIGERO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeAdecuado'] ?> medio" id="medio" href="#">ADECUADO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeDeficienciaLigera'] ?> bajo" id="bajo" href="#">DEFICIENCIA LIGERA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeDeficienciaExtrema'] ?> muy-bajo" id="muy-bajo" href="#">DEFICIENCIA EXTREMA</a>
            </li>
        </ul>
    </div>
</div>

<div class="contentBox" id="noHayDepAfectados">

    <h2 class="m-t-0" style="font-size: .8rem">
        <span class="text-info">
            DEPARTAMENTOS AFECTADOS:
        </span>
    </h2>
    <div id="ubicacion-dep_muy-alto" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarExcesoExtremo'] ?>">
        <p class="justify" style="margin-bottom: unset;
                border: solid 1px transparent;
                border-style: solid none;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
                border-right-style: solid;
                border-bottom-right-radius: 10px;
                border-top-right-radius: 10px;
                border-left-style: solid;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                background-color: #f7f7f7;">
            <?= @$ubicacionDepProv['ubicacionDepExcesoExtremo'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_alto" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarExcesoLigero'] ?>">
        <p class="justify" style="margin-bottom: unset;
                border: solid 1px transparent;
                border-style: solid none;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
                border-right-style: solid;
                border-bottom-right-radius: 10px;
                border-top-right-radius: 10px;
                border-left-style: solid;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                background-color: #f7f7f7;">
            <?= @$ubicacionDepProv['ubicacionDepExcesoLigero'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_medio" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarAdecuado'] ?>">
        <p class="justify" style="margin-bottom: unset; border: solid 1px transparent;
                border-style: solid none;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
                border-right-style: solid;
                border-bottom-right-radius: 10px;
                border-top-right-radius: 10px;
                border-left-style: solid;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                background-color: #f7f7f7;">
            <?= @$ubicacionDepProv['ubicacionDepAdecuado'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_bajo" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarDeficienciaLigera'] ?>">
        <p class="justify" style="margin-bottom: unset; border: solid 1px transparent;
                border-style: solid none;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
                border-right-style: solid;
                border-bottom-right-radius: 10px;
                border-top-right-radius: 10px;
                border-left-style: solid;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                background-color: #f7f7f7;">
            <?= @$ubicacionDepProv['ubicacionDepDeficienciaLigera'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_muy-bajo" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarDeficienciaExtrema'] ?>">
        <p class="justify" style="margin-bottom: unset; border: solid 1px transparent;
                border-style: solid none;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
                border-right-style: solid;
                border-bottom-right-radius: 10px;
                border-top-right-radius: 10px;
                border-left-style: solid;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                background-color: #f7f7f7;">
            <?= @$ubicacionDepProv['ubicacionDepDeficienciaExtrema'] ?>
        </p>
    </div>

    <div class="highcharts-figure highchart-dev" style="display: none;">
        <div id="graphic_dev"></div>
    </div>
    <hr>

    <div id="provAlertadas" class="d-none">

        <h2 class="m-t-0" style="font-size: .8rem">
            <span class="text-info">
                PROVINCIAS AFECTADAS:
            </span>
        </h2>
        <div id="ubicacion-prov_muy-alto" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarExcesoExtremo'] ?>">
            <p class="justify" style="margin-bottom: unset;
                    border: solid 1px transparent;
                    border-style: solid none;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                    border-right-style: solid;
                    border-bottom-right-radius: 10px;
                    border-top-right-radius: 10px;
                    border-left-style: solid;
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    background-color: #f7f7f7;">
                <?= @$ubicacionDepProv['ubicacionProvExcesoExtremo'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_alto" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarExcesoLigero'] ?>">
            <p class="justify" style="margin-bottom: unset;margin-bottom: unset;
                    border: solid 1px transparent;
                    border-style: solid none;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                    border-right-style: solid;
                    border-bottom-right-radius: 10px;
                    border-top-right-radius: 10px;
                    border-left-style: solid;
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    background-color: #f7f7f7;">
                <?= @$ubicacionDepProv['ubicacionProvExcesoLigero'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_medio" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarAdecuado'] ?>">
            <p class="justify" style="margin-bottom: unset;
                    border: solid 1px transparent;
                    border-style: solid none;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                    border-right-style: solid;
                    border-bottom-right-radius: 10px;
                    border-top-right-radius: 10px;
                    border-left-style: solid;
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    background-color: #f7f7f7;">
                <?= @$ubicacionDepProv['ubicacionProvAdecuado'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_bajo" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarDeficienciaLigera'] ?>">
            <p class="justify" style="margin-bottom: unset;
                    border: solid 1px transparent;
                    border-style: solid none;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                    border-right-style: solid;
                    border-bottom-right-radius: 10px;
                    border-top-right-radius: 10px;
                    border-left-style: solid;
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    background-color: #f7f7f7;">
                <?= @$ubicacionDepProv['ubicacionProvDeficienciaLigera'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_muy-bajo" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarDeficienciaExtrema'] ?>">
            <p class="justify" style="margin-bottom: unset;
                    border: solid 1px transparent;
                    border-style: solid none;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                    border-right-style: solid;
                    border-bottom-right-radius: 10px;
                    border-top-right-radius: 10px;
                    border-left-style: solid;
                    border-top-left-radius: 10px;
                    border-bottom-left-radius: 10px;
                    background-color: #f7f7f7;">
                <?= @$ubicacionDepProv['ubicacionProvDeficienciaExtrema'] ?>
            </p>
        </div>
    </div>
    <div class="highcharts-figure highchart-prov" style="display: none;">
        <div id="graphic_prov"></div>
    </div>
</div>