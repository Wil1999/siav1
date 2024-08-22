<div class="body">
    <div class="header">
        <div class="title">Índice de humedad</div>
        <div class="description">El mapa de índice de humedad provee información que involucra la relación entre la precipitación y la evapotranspiración a nivel nacional. El cálculo del índice tiene un horizonte decadal (del 11 al 20) y utiliza datos meteorológicos de la red de observación meteorológica del SENAMHI.</div>
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

        <?php Component::view('historial-rango-indice-humedad'); ?>

        <?php Component::view('table-rango-indice-humedad') ?>
        <hr>
        <div id="filterDevProv" class="contentBox"></div>
        <?php Component::view('filter-rango-indice-humedad') ?>
    </div>
</div>