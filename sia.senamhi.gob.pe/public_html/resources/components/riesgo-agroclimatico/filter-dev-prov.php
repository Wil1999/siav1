<?php
$ubicacion_riesgo = new UbicacionRiesgoController($_POST['lugaresAfectados']);

$leyendaDepProv = $ubicacion_riesgo->maxLeyenda();

$ubicacionDepProv = $ubicacion_riesgo->ubicacionDepProv();
?>

<div class="contentBox">
    <h2 class="m-t-0" style="font-size: 14px;
                                color: #555555;
                                line-height: 1.4;
                                text-transform: uppercase;
                                background-color: transparent;">
        <span>
            NIVELES DE RIESGO:
        </span>
    </h2>
    <div>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeMuyAlto'] ?> muy-alto" id="muy-alto" href="#">MUY ALTO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeAlto'] ?> alto" id="alto" href="#">ALTO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeMedio'] ?> medio" id="medio" href="#">MEDIO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeBajo'] ?> bajo" id="bajo" href="#">BAJO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $leyendaDepProv['activeMuyBajo'] ?> muy-bajo" id="muy-bajo" href="#">MUY BAJO</a>
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
    <div id="ubicacion-dep_muy-alto" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarMuyAlto'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepMuyAlto'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_alto" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarAlto'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepAlto'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_medio" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarMedio'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepMedio'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_bajo" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarBajo'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepBajo'] ?>
        </p>
    </div>

    <div id="ubicacion-dep_muy-bajo" class="ubicacionDep" style="<?= $leyendaDepProv['mostrarMuyBajo'] ?>">
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
            <?= @$ubicacionDepProv['ubicacionDepMuyBajo'] ?>
        </p>
    </div>

    <div id="provAlertadas" class="d-none">

        <h2 class="m-t-0" style="font-size: .8rem">
            <span class="text-info">
                PROVINCIAS AFECTADAS:
            </span>
        </h2>
        <div id="ubicacion-prov_muy-alto" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarMuyAlto'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvMuyAlto'] ?>
        </div>

        <div id="ubicacion-prov_alto" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarAlto'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvAlto'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_medio" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarMedio'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvMedio'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_bajo" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarBajo'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvBajo'] ?>
            </p>
        </div>

        <div id="ubicacion-prov_muy-bajo" class="ubicacionProv" style="<?= $leyendaDepProv['mostrarMuyBajo'] ?>">
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
                <?= @$ubicacionDepProv['ubicacionProvMuyBajo'] ?>
            </p>
        </div>
    </div>
</div>