<div class="contentBox historialBox d-none">
    <div class="comboSelector" style="padding-bottom: 1em;">
        <div class="comboSelectorBox" style="display: -ms-flexbox;
                    display: flex;
                    -ms-flex-pack: distribute;
                    justify-content: space-between;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    padding: 1rem 1.25rem;
                    background-color: #f7f7f7;
                    border-radius: 10px;">

            <select id="selectHistorialAnio" class="selectCustom">
                <option selected value="-">Seleccionar Año</option>
            </select>

            <select id="selectHistorialMes" class="selectCustom" disabled>
                <option selected value="-">Seleccionar Mes</option>
            </select>
        </div>
    </div>
</div>
<div class="contentBox mapHistorialContainer d-none">
    <div class="mapContainer">
        <div id="mapHistorial"></div>
    </div>
</div>

<div class="contentBox tablaHistorialContainer d-none">
    <table class="tabla-historial">
        <caption class="highcharts-table-caption">Historial</caption>
        <thead>
            <tr>
                <th class="text" scope="col">Nivel</th>
                <th class="text" scope="col">Area (km²)</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>