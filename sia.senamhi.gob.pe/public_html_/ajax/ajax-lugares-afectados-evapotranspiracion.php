<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../helpers/Format.php';
require_once '../src/UbicacionEvapotranspiracion/UbicacionEvapotranspiracionController.php';
require_once '../src/UbicacionEvapotranspiracion/UbicacionEvapotranspiracion.php';

if (isset($_POST['lugaresAfectados']) && !empty($_POST['lugaresAfectados'])) {
    $lugaresAfectados = $_POST['lugaresAfectados'];
} else {
    exit();
}

$jsonFeatures = array();

$ubicacion_riesgo = new UbicacionEvapotranspiracionController($lugaresAfectados);

$leyendaDepProv = $ubicacion_riesgo->maxLeyenda();

$ubicacionDepProv = $ubicacion_riesgo->ubicacionDepProv();
//echo print_r(explode(',',$ubicacionDepProv['ubicacionDep20-25']));
//echo $ubicacionDepProv['ubicacionDep45-50'];
//echo implode(',',$ubicacionDepProv);

?>

<p style="font-size: small; color: red;">Seleccionar el nivel de Probabilidad o departamento afectado de interés</p>
<!--<h1 onclick="myFunction()">Grafico</h1>-->
<a onclick="myFunction()" href="#" style="display:block;right:10px;margin-bottom: 10px;margin-top: 10px;"><span class="icon"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
<span class="title">Gráfico</span>    </a>

<script>
function myFunction() {
    $('#graphic_dev').show();
}
</script>
<div class="contentBox" >
    <h2 class="m-t-0" style="font-size: 14px;
                                color: #555555;
                                line-height: 1.4;
                                text-transform: uppercase;
                                background-color: transparent;">
        <span style="text-transform: capitalize;">
         Seleccione el Rango <span style="text-transform: lowercase;">(mm)</span>:
        </span>
        
    </h2>
    <br>

    <div >
        <ul class="nav nav-pills" id="pills-tab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeMayor70'] ?> mayor-70" id="mayor-70" href="#">> 70</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active60-70'] ?> entre-60-70" id="entre-60-70" href="#">60 - 70</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active50-60'] ?> entre-50-60" id="entre-50-60" href="#">50 - 60</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active45-50'] ?> entre-45-50" id="entre-45-50" href="#">45 - 50</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active40-45'] ?> entre-40-45" id="entre-40-45" href="#">40 - 45</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active35-40'] ?> entre-35-40" id="entre-35-40" href="#">35 - 40</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active30-35'] ?> entre-30-35" id="entre-30-35" href="#">30 - 35</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active25-30'] ?> entre-25-30" id="entre-25-30" href="#">25 - 30</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active20-25'] ?> entre-20-25" id="entre-20-25" href="#">20 - 25</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active15-20'] ?> entre-15-20" id="entre-15-20" href="#">15 - 20</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active10-15'] ?> entre-10-15" id="entre-10-15" href="#">10 - 15</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active5-10'] ?> entre-5-10" id="entre-5-10" href="#">5 - 10</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['active0-5'] ?> entre-0-5" id="entre-0-5" href="#">0 - 5</a>
            </li>
        </ul>
    </div>
</div>
<br>
<h2 class="m-t-0" style="font-size: .8rem">
        <span class="text-info">
            DEPARTAMENTOS AFECTADOS:
        </span>
    </h2>
<div class="contentBox" id="noHayDepAfectados" >


    <div id="ubicacion-dep_mayor-70" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarMayor70'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepMayor70'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-60-70" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar60-70'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep60-70'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-50-60" class="ubicacionDep" style=" <?= $leyendaDepProv['mostrar50-60'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep50-60'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-45-50" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar45-50'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep45-50'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-40-45" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar40-45'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep40-45'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-35-40" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar35-40'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep35-40'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-30-35" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar30-35'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep30-35'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-25-30" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar25-30'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep25-30'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-20-25" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar20-25'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep20-25'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-15-20" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar15-20'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep15-20'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-10-15" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar10-15'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep10-15'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-5-10" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar5-10'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep5-10'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_entre-0-5" class="ubicacionDep" style="<?= $leyendaDepProv['mostrar0-5'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDep0-5'] ?>
        </p>
    </div>

   <hr>

    <div id="provAlertadas" class="d-none">

        <h2 class="m-t-0" style="font-size: .8rem">
            <span class="text-info">
                PROVINCIAS AFECTADAS:
            </span>
        </h2>
        <div id="ubicacion-prov_mayor-70" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarMayor70'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvMayor70'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-60-70" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar60-70'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv60-70'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-50-60" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar50-60'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv50-60'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-45-50" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar45-50'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv45-50'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-40-45" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar40-45'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv40-45'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-35-40" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar35-40'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv35-40'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-30-35" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar30-35'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv30-35'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-25-30" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar25-30'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv25-30'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-20-25" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar20-25'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv20-25'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-15-20" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar15-20'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv15-20'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-10-15" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar10-15'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv10-15'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-5-10" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar5-10'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv5-10'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_entre-0-5" class="ubicacionProv" style="<?= $leyendaDepProv['mostrar0-5'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProv0-5'] ?>
            </p>
        </div>
    </div>
 <!--
   <div class="highcharts-figure highchart-dev" style="display: none;">
        <div id="graphic_dev"></div>
    </div>
  
    <div class="highcharts-figure highchart-prov" style="display: none;">
        <div id="graphic_prov"></div>
    </div>
</div>

            -->