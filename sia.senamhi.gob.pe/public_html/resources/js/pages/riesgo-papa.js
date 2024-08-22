const CENTERLAT = -9.1951786;
const CENTERLONG = -74.9904165;
const zoomInicial = 6;
const IMAGEN_BOUNDS_HISTORIAL = [
    [-18.4427947998047, -81.3917770385742],
    [0.0529556907713413, -68.5900115966797],
]

var mymap;
var mapHistorial;
var kmlDepLayer;
var kmlProvLayer;
var provName;
function createMap() {
    const CENTERLAT = -9.1951786;
    const CENTERLONG = -74.9904165;
    let zoomInicial = 6;

    let departamento = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
        layers: 'g_00_02:00_02_002_03_000_000_0000_00_00',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    let provincia = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
        layers: 'g_00_02:00_02_003_03_000_000_0000_00_00',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    let distrito = L.tileLayer.wms('https://idesep.senamhi.gob.pe:443/geoserver/g_carto_fundamento/wms', {
        layers: 'g_carto_fundamento:distritos',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    let sourceReser;

    let OpenMap = {
        Streets: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            //retina: '@2x',
            detectRetina: true
        }),
        OpenTopoMap: L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
            //retina: '@2x',
            detectRetina: true
        }),
        EsriWorldPhysical: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Physical_Map/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: US National Park Service',
            maxZoom: 19,
            detectRetina: true
        }),
        EsriWorldImagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
            maxZoom: 19,
            detectRetina: true
        })
    };

    window.ExampleData = {
        Basemaps: OpenMap
    };

    let My_Source = L.WMS.Source.extend({
        onAdd: function () {
            this.refreshOverlay()
        },
        onRemove: function () {
            var subLayers = Object.keys(this._subLayers).join(",");
            if (!this._map) {
                return
            }
            if (subLayers) {
                this._overlay.remove();
            }
        },
        getEvents: function () {
            if (this.options.identify) {
                return {
                    click: this.identify
                }
            } else {
                return {}
            }
        },
        getFeatureInfo: function (point, latlng, layers, callback) {
            var params = this.getFeatureInfoParams(point, layers),
                url = this._url + L.Util.getParamString(params, this._url);
            if (url) {
                getFeatureInfo(url, latlng)
            }
        }
    });

    filter = "1=1";
    load_monitoreos(filter);

    function load_monitoreos(filter) {

        sourceReser = new My_Source('https://idesep.senamhi.gob.pe/geoserver/g_11_03/wms?', {
            id: '11_03_001_03_001_531_0000_00_00',
            cql_filter: filter,
            //cql_filter: "nivel IN ('Muy Alto', 'Alto', 'Medio', 'Bajo', 'Muy Bajo')",
            transparent: true,
            format: 'image/png',
            info_format: 'application/json',
            transparent: true,
            tiled: 'true',
            detectRetina: true,
            opacity: 0.75
        });

    }

    mymap = L.map('mapid', {
        center: [CENTERLAT, CENTERLONG],
        zoom: zoomInicial,
        minZoom: zoomInicial,
        zoomControl: false,
        layers: [ExampleData.Basemaps.Streets, sourceReser, departamento]
    });

    //mymap.createPane("departamento");
    //mymap.createPane("provincia");
    //mymap.createPane("distrito");

    sourceReser.getLayer('11_03_001_03_001_531_0000_00_00').addTo(mymap);
    //departamento.addTo(mymap);


    function setCql(filter) {

        if (mymap.hasLayer(sourceReser)) {
            mymap.removeLayer(sourceReser);
        }

        load_monitoreos(filter)

        sourceReser.getLayer('11_03_001_03_001_531_0000_00_00').addTo(mymap);
    }


    let groupedOverlays = {
        'Capas': {
            'Cartografía Temática': sourceReser
        },
        'Zonas': {
            'Departamentos': departamento,
            'Provincias': provincia,
            'Distritos': distrito
        }
    };

    let options = {
        exclusiveGroups: ['Zonas', 'Reservorios'],
    };

    let layerControl = L.control.groupedLayers(ExampleData.Basemaps, groupedOverlays, options);

    //Creamos un control para la leyenda en el lado inferior izquierda
    let legend = L.control({
        position: 'bottomright'
    });

    var zoomHome = L.Control.zoomHome({
        position: 'topright',
        zoomHomeTitle: 'Centrar Mapa'
    });

    //Funcion para aÃ±adir la imagen de leyenda a un div
    legend.onAdd = function () {

        this.div = L.DomUtil.create('div', 'logo-map_sia');
        var img_log = '<img style="height: 100px" src="public/assets/img/logo-SIA.svg" alt="Logotipo SIA" />';

        this.div.innerHTML = img_log;
        return this.div;
    };

    //AÃ±adir la leyenda al mapa
    legend.addTo(mymap);
    mymap.addControl(layerControl);
    zoomHome.addTo(mymap);

    $('.chkZona').on('change', function (e) {

        var filtro = "";

        $('.chkZona').each(function (irow, vrow) {
            if ($(vrow).is(':checked')) {
                var id = $(vrow).val();
                filtro += "'" + id + "'" + ",";
            }
        })

        filtro = filtro.substring(0, filtro.length - 1);
        filtro = "nivel IN (" + filtro + ")";

        console.log(filtro)

        setCql(filtro);
    });

    $('#chboxAll').on('change', function (e) {
        $(".chkZona").prop("checked", this.checked);
        console.log("selecciona.....");
        if ($(".chkZona").length == $(".chkZona:checked").length) {
            $("#chboxAll").prop("checked", true);
            filter = "1=1";
            $(".selectorText").html("Deseleccionar:");
            setCql(filter);
        } else {
            $("#chboxAll").prop("checked", false);
            $(".selectorText").html("Seleccionar:");
            filter = "-1";
            setCql(filter);
        }
    });
}


function getFeatureInfo(url, latlng) {
    console.log(latlng)
    /*
    let datos = new FormData();
    datos.append('url', url);

    $.ajax({
        dataType: "json",
        type: "POST",
        url: "ajax/ajax-riesgo-agro.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,

    })
        .done(function (data) {
            console.log('[DATA] => ', data)
            if (data) {
                const panelControlButton = $('.panelControl_button');
                const panelControl = $('.panelControl')

                panelControlButton.removeClass('collapsed')
                panelControl.removeClass('collapsed')


                let column1 = $('.table-body .column-1')
                let column2 = $('.table-body .column-2')
                let column3 = $('.table-body .column-3')

                column1.html(data.nivel)
                column2.html(data.area)
                column3.html(data.perimetro)
            }
        })
        .always(function (data) {
            console.log('always')
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
        })
    */
}


function getFicha() {
    let product_esquema = $('#product_esquema').val();
    let product_tabla = $('#product_tabla').val();
    $.get(`http://sia.senamhi.gob.pe:8080/sia/producto/${product_esquema}/${product_tabla}`)
        .done(function (data) {
            if (data.enlace) {

                let headerFile = $('.header .file')

                headerFile.html(`
                    <a href="${data.enlace}" target="_blank" rel="noopener noreferrer">
                        <i class="material-icons">file_download</i>
                        ${data.nombre}
                    </a>
                `)
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
        })
        .always(function () {
            console.log('always')
        });
}

function getPresentInfo() {
    let product_urlWms = $('#product_urlWms').val();
    let product_layerWms = $('#product_layerWms').val();
    let product_esquema = $('#product_esquema').val();
    let product_tabla = $('#product_tabla').val();
    let product_anio = $('#product_anio').val();
    let product_mes = $('#product_mes').val();

    $.get(`http://sia.senamhi.gob.pe:8080/sia/producto/historial/${product_esquema}/${product_tabla}/${product_anio}/${product_mes}`)
        .done(function (data) {
            if (data.leyenda) {
                let result = data.leyenda;

                result.forEach(nivel => {
                    if (nivel.descripcion.toLowerCase().match(/^muy alto$/)) {
                        let column2 = $('.table-body .column-2')
                        column2.html(nivel.area)
                    }

                    if (nivel.descripcion.toLowerCase().match(/^alto$/)) {
                        let column5 = $('.table-body .column-5')
                        column5.html(nivel.area)
                    }

                    if (nivel.descripcion.toLowerCase().match(/^medio$/)) {
                        let column8 = $('.table-body .column-8')
                        column8.html(nivel.area)
                    }

                    if (nivel.descripcion.toLowerCase().match(/^bajo$/)) {
                        let column11 = $('.table-body .column-11')
                        column11.html(nivel.area)
                    }

                    if (nivel.descripcion.toLowerCase().match(/^muy bajo$/)) {
                        let column14 = $('.table-body .column-14')
                        column14.html(nivel.area)
                    }
                });
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
        })
        .always(function () {
            console.log('always')
        });
}

async function getLugaresAfectados() {
    let product_lugaresAfectados = $('#product_lugaresAfectados').val();
    let filterDevProv = $('#filterDevProv');

    let datos = new FormData();
    datos.append('lugaresAfectados', product_lugaresAfectados);

    await $.ajax({
        dataType: "html",
        type: "POST",
        url: "ajax/ajax-lugares-afectados.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done(function (data) {
            if (data) {
                filterDevProv.append(data)
            }
        })
        .always(function (data) {
            console.log('always')
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
        })

    getGraficoDepProv();

    $('.depBuscarZoom').on('click', function () {
        let depName = $(this).attr('id');
        let product_esquema = $('#product_esquema').val();
        let product_tabla = $('#product_tabla').val();
        let product_anio = $('#product_anio').val();
        var graphicChartDev = $('#graphic_dev').highcharts();

        var styleColor = {
            color: '#3481FF',
            weight: 1.5,
            fill: false,
            fillOpacity: 0.15
        };

        var myCustomGroup = L.geoJSON(null, {
            style: styleColor
        });

        $('#provAlertadas').show();

        $('#provAlertadas h2 span').html(`PROVINCIAS AFECTADAS DE ${depName.replaceAll('-', ' ').toUpperCase()}:`);

        if (kmlDepLayer == undefined || kmlDepLayer == null) {
            kmlDepLayer = omnivore.kml('./kml/' + depName + '.kml', null, myCustomGroup).on('ready', function () {
                mymap.fitBounds(kmlDepLayer.getBounds())
            });

            kmlDepLayer.addTo(mymap);

            provName = $('.dep_' + depName);
            provName.show();

            if (provName.length <= 0) {
                $('#provAlertadas').hide();
            }

        } else {
            mymap.removeLayer(kmlDepLayer);

            if (kmlProvLayer == undefined || kmlProvLayer == null) {
                // Continua igual
            } else {
                mymap.removeLayer(kmlProvLayer);
            }

            provName.hide();
            kmlDepLayer = omnivore.kml('./kml/' + depName + '.kml', null, myCustomGroup).on('ready', function () {
                mymap.fitBounds(kmlDepLayer.getBounds(), {
                    animate: true
                })
            });

            provName = $('.dep_' + depName);
            provName.show();

            kmlDepLayer.addTo(mymap);

            //console.log($('.dep_' + depName).length)
            if (provName.length <= 0) {
                $('#provAlertadas').hide()
            }
        }

        $.get(`http://sia.senamhi.gob.pe:8080/sia/dashboard/riesgo/${product_esquema}/${product_tabla}/${product_anio}/${depName.replaceAll('-', ' ').toUpperCase()}`)
            .done(function (data) {
                if (data) {
                    let series = data.series;

                    graphicChartDev.update({
                        series
                    }, false);

                    $('.highchart-dev').show()

                    graphicChartDev.redraw();
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
            })
            .always(function () {
                console.log('always')
            });
    })

    $('.depTotales').on('click', function () {

        /**-- Atrapamos el id que contiene el nombre del departamento y la provincia --**/
        var provDepName = $(this).attr('id');

        /**-- Atrapamos el departamento y la provincia separados por un '_' --**/
        var nombreDepProv = provDepName.split('_');

        var nombreProvincia = nombreDepProv[1];
        var graphicChartProv = $('#graphic_prov').highcharts();
        let product_esquema = $('#product_esquema').val();
        let product_tabla = $('#product_tabla').val();
        let product_anio = $('#product_anio').val();

        //console.log('EJEM => ', nombreProvincia);

        /**-- Le damos estilos al kml --**/
        var styleColor = {
            color: '#000000',
            weight: 1.5,
            fill: false,
            fillOpacity: 0.15
        };

        /**--  --**/
        var myCustomGroup = L.geoJSON(null, {
            style: styleColor
        });

        $('#distAlertadas').show();


        if (kmlProvLayer == undefined || kmlProvLayer == null) {
            kmlProvLayer = omnivore.kml('./kml/dep_' + nombreDepProv[0] + '/' + nombreDepProv[1] + '.kml', null, myCustomGroup).on('ready', function () {
                mymap.fitBounds(kmlProvLayer.getBounds(), {
                    animate: true
                })
            });

            distName = $('.prov_' + nombreProvincia);
            distName.show();

            kmlProvLayer.addTo(mymap);

            if (distName.length <= 0) {
                $('#distAlertadas').hide();
            }


        } else {
            mymap.removeLayer(kmlProvLayer);

            distName.hide();

            kmlProvLayer = omnivore.kml('./kml/dep_' + nombreDepProv[0] + '/' + nombreDepProv[1] + '.kml', null, myCustomGroup).on('ready', function () {
                mymap.fitBounds(kmlProvLayer.getBounds(), {
                    animate: true
                })
            });

            distName = $('.prov_' + nombreProvincia);
            distName.show();

            kmlProvLayer.addTo(mymap);

            if (distName.length <= 0) {
                $('#distAlertadas').hide();
            }
        }

        /*
        $.get(`http://sia.senamhi.gob.pe:8080/sia/dashboard/riesgo/${product_esquema}/${product_tabla}/2022/${nombreDepProv[0].replaceAll('-', ' ').toUpperCase()}/${nombreDepProv[1].replaceAll('-', ' ').toUpperCase()}`)
            .done(function (data) {
                if (data) {
                    let series = data.series;

                    graphicChartProv.update({
                        series
                    }, false);

                    $('.highchart-prov').show()

                    graphicChartProv.redraw();
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
            })
            .always(function () {
                console.log('always')
            });
        */
    });

    $('.nav .nav-item').on('click', function (e) {
        $('.nav .nav-item a').removeClass('active');
        $(this).children().addClass('active');

        let leyendaName = $(this).children().attr('id');

        $('.ubicacionDep').hide();
        $('.ubicacionProv').hide();
        $('.highchart-dev').hide();
        $('#ubicacion-dep_' + leyendaName).show();
        $('#ubicacion-prov_' + leyendaName).show();

        if ($('.dep_' + leyendaName).length <= 0) {
            $('#provAlertadas').hide()
        }
    })

}

function getGraficoDepProv() {
    Highcharts.chart('graphic_dev', {
        chart: {
            type: 'column'
        },
        title: {
            text: null
        },
        xAxis: {
            categories: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'N° de provincias'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            "name": "Muy Alto",
            "data": [],
            "color": '#ff2200'
        },
        {
            "name": "Alto",
            "data": [],
            "color": '#ff9900'
        },
        {
            "name": "Medio",
            "data": [],
            "color": '#ff0'
        },
        {
            "name": "Bajo",
            "data": [],
            "color": '#7aab00'
        },
        {
            "name": "Muy Bajo",
            "data": [],
            "color": '#006100'
        }]
    });
    /*
        Highcharts.chart('graphic_prov', {
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                "name": "Muy Alto",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            },
            {
                "name": "Alto",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            },
            {
                "name": "Medio",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            },
            {
                "name": "Bajo",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            },
            {
                "name": "Muy Bajo",
                "data": [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            }
            ]
        });
    */
}

function getHistorialProduct() {
    let product_esquema = $('#product_esquema').val();
    let product_tabla = $('#product_tabla').val();
    let selectHistorialAnio = $('#selectHistorialAnio');
    let selectHistorialMes = $('#selectHistorialMes');

    $.get(`http://sia.senamhi.gob.pe:8080/sia/producto/anio/${product_esquema}/${product_tabla}`)
        .done(function (data) {
            if (data) {
                $('.mapHistorialContainer').hide()

                data.forEach(el => {
                    selectHistorialAnio.append(`
                    <option value="${el}">${el}</option>
                    `);
                })
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
        })
        .always(function () {
            console.log('always')
        });

    $('#selectHistorialAnio').on('change', function (el) {
        $('#selectHistorialMes').prop('disabled', 'disabled');

        let anioSelected = this.value;

        if (anioSelected !== '-') {

            $('#selectHistorialMes option').not(':first').remove();

            $.get(`http://sia.senamhi.gob.pe:8080/sia/producto/mes/${product_esquema}/${product_tabla}/${anioSelected}`)
                .done(function (data) {
                    if (data) {

                        data.forEach(el => {
                            selectHistorialMes.append(`
                        <option data-anio="${anioSelected}" value="${el}">${el}</option>
                        `);
                        })
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
                })
                .always(function () {
                    console.log('always')
                });

            $('#selectHistorialMes').prop('disabled', false);
        }
    })

    $('#selectHistorialMes').on('change', function (el) {
        let mesSelected = this.value;
        let anioSelected = $(this).find(':selected').data('anio')

        $.get(`http://sia.senamhi.gob.pe:8080/sia/producto/historial/${product_esquema}/${product_tabla}/${anioSelected}/${mesSelected}`)
            .done(function (data) {
                if (data) {
                    $('.mapHistorialContainer').show()
                    $('.tablaHistorialContainer').show()

                    $('.tabla-historial tbody tr').remove();
                    data.leyenda.forEach(elem => {
                        $('.tabla-historial tbody').append(`
                            <tr>
                                <td>${elem.descripcion}</td>
                                <td>${elem.area}</td>
                            </tr>
                        `)
                    })

                    $('#historialPanel').data('state', 'complete')

                    if (mapHistorial != undefined) { mapHistorial.remove(); }

                    var departamento = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
                        layers: 'g_00_02:00_02_002_03_000_000_0000_00_00',
                        format: 'image/png',
                        transparent: true,
                        tiled: 'true',
                        detectRetina: true,
                        opacity: 0.7
                    })

                    var stadiamaps = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                        attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
                        maxZoom: 18,
                    })

                    mapHistorial = L.map('mapHistorial', {
                        preferCanvas: true,
                        zoomControl: false,
                        scrollWheelZoom: false,
                        dragging: false,
                        center: [-18.1951786, -74.9904165],
                        zoom: 5,
                        minZoom: 5,
                        layers: [stadiamaps, departamento],
                    });


                    L.imageOverlay('data:image/png;base64,' + data.imagen, IMAGEN_BOUNDS_HISTORIAL).addTo(mapHistorial);
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('[ERROR] => ', { jqXHR, textStatus, errorThrown })
            })
            .always(function () {
                console.log('always')
            });
    })
}

function getDetailsProduct() {
    let product_grupoNomCorto = $('#product_grupoNomCorto').val();
    let product_objetoNombreCorto = $('#product_objetoNombreCorto').val();
    $('.panelControl_details .body .header .title').html(`Pronóstico de Riesgo Agroclimático - ${product_grupoNomCorto}`);
}

getDetailsProduct();

getHistorialProduct();

getLugaresAfectados();

createMap();

getPresentInfo();

//getFicha();

$('.changePanel').on('click', function (el) {
    $('.changePanel').removeClass('active')
    $('.panelControl_details .body .content .contentBox').toggle();
    $('#changeActualHistorial').show()

    $('.mapHistorialContainer').hide()
    $('.tablaHistorialContainer').hide()

    if ($(this).data('state') === 'complete') {
        $('.mapHistorialContainer').show()
        $('.tablaHistorialContainer').show()
    }
    $(this).addClass('active')
})