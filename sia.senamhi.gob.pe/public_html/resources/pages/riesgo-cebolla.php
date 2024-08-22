<div class="body">
    <div class="header">
        <div class="title">Pronóstico de Riesgo Agroclimático</div>
        <div class="description">El mapa provee información pronosticada del riesgo agroclimático para cebolla que podría presentarse en los próximos meses. La información presentada en el mapa proviene de la red de observación meteorológica del SENAMHI.</div>
        <div class="file"></div>
    </div>
    <hr>
    <div class="content">
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

        <?php Component::view('historial-riesgo'); ?>

        <?php Component::view('table-nivel'); ?>
        <hr>
        <div id="filterDevProv" class="contentBox"></div>
        <?php Component::view('filter-nivel'); ?>
    </div>
</div>