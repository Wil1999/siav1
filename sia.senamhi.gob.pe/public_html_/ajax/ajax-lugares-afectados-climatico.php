    <?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../helpers/Format.php';
require_once '../src/UbicacionClimatico/UbicacionClimaticoController.php';
require_once '../src/UbicacionClimatico/UbicacionClimatico.php';

if (isset($_POST['lugaresAfectados']) && !empty($_POST['lugaresAfectados'])) {
    $lugaresAfectados = $_POST['lugaresAfectados'];
    $page = $_POST['page'];
    $sobre_normal = ($page == 'climatico-tmin' || $page ==  'climatico-tmax') ? 'sobre-normal-red' : 'sobre-normal';
    $bajo_normal = ($page == 'climatico-tmin' || $page ==  'climatico-tmax') ? 'bajo-normal-blue' : 'bajo-normal';
} else {
    exit();
}

$jsonFeatures = array();

$ubicacion_riesgo = new UbicacionClimaticoController($lugaresAfectados);

$leyendaDepProv = $ubicacion_riesgo->maxLeyenda();

$ubicacionDepProv = $ubicacion_riesgo->ubicacionDepProv();

?>

<p style="font-size: small; color: red;">Seleccionar el nivel de Probabilidad o departamento afectado de interés</p>

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
            PROBABILIDAD:
        </span>
    </h2>
    <div>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeSobreNormal'] ?> <?= $sobre_normal ?>" id="sobre-normal" href="#">SOBRE LO NORMAL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeNormal'] ?> normal" id="normal" href="#">NORMAL</a>
            </li>

            <?php if ($page == 'climatico-pp') : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $leyendaDepProv['activeBajoNormal'] ?> bajo-normal" id="bajo-normal" href="#">BAJO LO NORMAL</a>
                </li>
            <?php endif; ?>

            <?php if ($page == 'climatico-tmin' || $page == 'climatico-tmax') : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $leyendaDepProv['activeBajoNormal'] ?> <?= $bajo_normal ?>" id="bajo-normal" href="#">BAJO LO NORMAL</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeNoSignificativoEstadisticamente'] ?> no-significativo-estadisticamente" id="no-significativo-estadisticamente" href="#">NO SIGNIFICATIVO ESTADISTICAMENTE</a>
            </li>
            <?php if ($page == 'climatico-pp') : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $leyendaDepProv['activePeriodoSeco'] ?> periodo-seco" id="periodo-seco" href="#">PERIODO SECO</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>

<div class="contentBox" id="noHayDepAfectados">

    <h2 class="m-t-0" style="font-size: .8rem">
        <span class="text-info">
            DEPARTAMENTOS AFECTADOS:
        </span>
    </h2>
    <div id="ubicacion-dep_sobre-normal" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarSobreNormal'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepSobreNormal'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_normal" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarNormal'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepNormal'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_bajo-normal" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarBajoNormal'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepBajoNormal'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_no-significativo-estadisticamente" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarNoSignificativoEstadisticamente'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepNoSignificativoEstadisticamente'] ?>
        </p>
    </div>

    <?php if ($page == 'climatico-pp') : ?>
        <div id="ubicacion-dep_periodo-seco" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarPeriodoSeco'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionDepPeriodoSeco'] ?>
            </p>
        </div>
    <?php endif; ?>

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
        <div id="ubicacion-prov_sobre-normal" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarSobreNormal'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvSobreNormal'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_normal" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarNormal'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvNormal'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_bajo-normal" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarBajoNormal'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvBajoNormal'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_no-significativo-estadisticamente" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarNoSignificativoEstadisticamente'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvNoSignificativoEstadisticamente'] ?>
            </p>
        </div>

        <?php if ($page == 'climatico-pp') : ?>
            <div id="ubicacion-prov_periodo-seco" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarPeriodoSeco'] ?>">
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
                    <?= @$ubicacionDepProv['ubicacionProvPeriodoSeco'] ?>
                </p>
            </div>
        <?php endif; ?>

    </div>

    <div class="highcharts-figure highchart-prov" style="display: none;">
        <div id="graphic_prov"></div>
    </div>
</div>