<div class="body">
    <div class="header">
        <div class="title">Probabilidad de Ocurrencia de Precipitación Trimestral</div>
        <div class="description">El mapa provee información de Probabilidad de Ocurrencia de Precipitación a nivel nacional, en los próximos 3 meses.</div>
        <div class="file"></div>
    </div>
    <hr>
    <div class="content">
        <!--
        <div id="changeActualHistorial" class="contentBox">
            <div style="font-size: smaller;
            text-align: center;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-content: center;">
                <a id="actualPanel" class="changePanel active">Información Actual</a>|<a id="historialPanel" data-state="incomplete" class="changePanel">Historial</a>
            </div>
        </div>
        -->

        <?php Component::view('historial-escenario-climatico'); ?>

        <?php Component::view('table-escenario-climatico') ?>
        <hr>
        <div id="filterDevProv" class="contentBox"></div>
        <?php Component::view('filter-escenario-climatico') ?>
    </div>
</div>