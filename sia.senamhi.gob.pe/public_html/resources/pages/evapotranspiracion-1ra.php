<div class="body">
    <div class="header">
        <div class="title">Evapotranspiración de referencia</div>
        <div class="description">El mapa de evapotranspiración de referencia no considera las características del cultivo, ni factores del suelo; es un parámetro relacionado con el clima. Su cálculo tiene un horizonte decadal (del 01 al 10) y utiliza datos meteorológicos de radiación, temperatura del aire, humedad atmosférica y velocidad del viento provenientes de la red de observación meteorológica del SENAMHI.</div>
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

        <?php Component::view('historial-rango-evapotranspiracion'); ?>

        <?php Component::view('table-rango-evapotranspiracion') ?>
        <hr>
        <div id="filterDevProv" class="contentBox"></div>
        <?php Component::view('filter-rango-evapotranspiracion') ?>
    </div>
</div>