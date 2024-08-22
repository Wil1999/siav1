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
    var zoomInicial = 6;

    var departamento = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
        layers: 'g_00_02:00_02_002_03_000_000_0000_00_00',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    var provincia = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
        layers: 'g_00_02:00_02_003_03_000_000_0000_00_00',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    var distrito = L.tileLayer.wms('https://idesep.senamhi.gob.pe:443/geoserver/g_carto_fundamento/wms', {
        layers: 'g_carto_fundamento:distritos',
        format: 'image/png',
        transparent: true,
        tiled: 'true',
        //retina: '@2x',
        detectRetina: true,
    });

    var sourceReser;

    var OpenMap = {
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

    var My_Source = L.WMS.Source.extend({
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

        sourceReser = new My_Source('https://idesep.senamhi.gob.pe/geoserver/g_04_06/wms?', {
            cql_filter: filter,
            //cql_filter: "rango IN ('> 70', '60 - 70')",
            transparent: true,
            format: 'image/png',
            info_format: 'application/json',
            transparent: true,
            tiled: 'true',
            detectRetina: true,
            opacity: 0.9
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

    sourceReser.getLayer('04_06_002_03_001_531_0000_00_00').addTo(mymap);
    //departamento.addTo(mymap);

    function setCql(filter) {

        if (mymap.hasLayer(sourceReser)) {
            mymap.removeLayer(sourceReser);
        }

        load_monitoreos(filter)

        sourceReser.getLayer('04_06_002_03_001_531_0000_00_00').addTo(mymap);
    }


    var groupedOverlays = {
        'Capas': {
            'Cartografía Temática': sourceReser
        },
        'Zonas': {
            'Departamentos': departamento,
            'Provincias': provincia,
            'Distritos': distrito
        }
    };

    var options = {
        exclusiveGroups: ['Zonas', 'Reservorios'],
    };

    var layerControl = L.control.groupedLayers(ExampleData.Basemaps, groupedOverlays, options);

    //Creamos un control para la leyenda en el lado inferior izquierda
    var legend = L.control({
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
        filtro = "rango IN (" + filtro + ")";

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
        url: "ajax/ajax-evapotranspiracion.php",
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

                column1.html(data.rango)
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
                    if (nivel.descripcion.toLowerCase().includes('> 70')) {
                        let column1 = $('.table-body .column-1')
                        let column2 = $('.table-body .column-2')
                        let column3 = $('.table-body .column-3')
                        let column4 = $('.table-body .column-4')
                        column1.html(nivel.descripcion)
                        column2.html(nivel.area)
                        column3.html(nivel.perimetro)
                        column4.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('60 - 70')) {
                        let column5 = $('.table-body .column-5')
                        let column6 = $('.table-body .column-6')
                        let column7 = $('.table-body .column-7')
                        let column8 = $('.table-body .column-8')
                        column5.html(nivel.descripcion)
                        column6.html(nivel.area)
                        column7.html(nivel.perimetro)
                        column8.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('50 - 60')) {
                        let column9 = $('.table-body .column-9')
                        let column10 = $('.table-body .column-10')
                        let column11 = $('.table-body .column-11')
                        let column12 = $('.table-body .column-12')
                        column9.html(nivel.descripcion)
                        column10.html(nivel.area)
                        column11.html(nivel.perimetro)
                        column12.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('45 - 50')) {
                        let column13 = $('.table-body .column-13')
                        let column14 = $('.table-body .column-14')
                        let column15 = $('.table-body .column-15')
                        let column16 = $('.table-body .column-16')
                        column13.html(nivel.descripcion)
                        column14.html(nivel.area)
                        column15.html(nivel.perimetro)
                        column16.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('40 - 45')) {
                        let column17 = $('.table-body .column-17')
                        let column18 = $('.table-body .column-18')
                        let column19 = $('.table-body .column-19')
                        let column20 = $('.table-body .column-20')
                        column17.html(nivel.descripcion)
                        column18.html(nivel.area)
                        column19.html(nivel.perimetro)
                        column20.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('35 - 40')) {
                        let column21 = $('.table-body .column-21')
                        let column22 = $('.table-body .column-22')
                        let column23 = $('.table-body .column-23')
                        let column24 = $('.table-body .column-24')
                        column21.html(nivel.descripcion)
                        column22.html(nivel.area)
                        column23.html(nivel.perimetro)
                        column24.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('30 - 35')) {
                        let column25 = $('.table-body .column-25')
                        let column26 = $('.table-body .column-26')
                        let column27 = $('.table-body .column-27')
                        let column28 = $('.table-body .column-28')
                        column25.html(nivel.descripcion)
                        column26.html(nivel.area)
                        column27.html(nivel.perimetro)
                        column28.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('25 - 30')) {
                        let column29 = $('.table-body .column-29')
                        let column30 = $('.table-body .column-30')
                        let column31 = $('.table-body .column-31')
                        let column32 = $('.table-body .column-32')
                        column29.html(nivel.descripcion)
                        column30.html(nivel.area)
                        column31.html(nivel.perimetro)
                        column32.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('20 - 25')) {
                        let column33 = $('.table-body .column-33')
                        let column34 = $('.table-body .column-34')
                        let column35 = $('.table-body .column-35')
                        let column36 = $('.table-body .column-36')
                        column33.html(nivel.descripcion)
                        column34.html(nivel.area)
                        column35.html(nivel.perimetro)
                        column36.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('15 - 20')) {
                        let column37 = $('.table-body .column-37')
                        let column38 = $('.table-body .column-38')
                        let column39 = $('.table-body .column-39')
                        let column40 = $('.table-body .column-40')
                        column37.html(nivel.descripcion)
                        column38.html(nivel.area)
                        column39.html(nivel.perimetro)
                        column40.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('10 - 15')) {
                        let column41 = $('.table-body .column-41')
                        let column42 = $('.table-body .column-42')
                        let column43 = $('.table-body .column-43')
                        let column44 = $('.table-body .column-44')
                        column41.html(nivel.descripcion)
                        column42.html(nivel.area)
                        column43.html(nivel.perimetro)
                        column44.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('5 - 10')) {
                        let column45 = $('.table-body .column-45')
                        let column46 = $('.table-body .column-46')
                        let column47 = $('.table-body .column-47')
                        let column48 = $('.table-body .column-48')
                        column45.html(nivel.descripcion)
                        column46.html(nivel.area)
                        column47.html(nivel.perimetro)
                        column48.html(nivel.periodo)
                    }

                    if (nivel.descripcion.toLowerCase().includes('0 - 5')) {
                        let column49 = $('.table-body .column-49')
                        let column50 = $('.table-body .column-50')
                        let column51 = $('.table-body .column-51')
                        let column52 = $('.table-body .column-52')
                        column49.html(nivel.descripcion)
                        column50.html(nivel.area)
                        column51.html(nivel.perimetro)
                        column52.html(nivel.periodo)
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
        url: "ajax/ajax-lugares-afectados-evapotranspiracion.php",
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

        $.get(`http://sia.senamhi.gob.pe:8080/sia/dashboard/monitoreo/${product_esquema}/${product_tabla}/${product_anio}/${depName.replaceAll('-', ' ').toUpperCase()}`)
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
            type: 'area'
        },
        title: {
            text: null
        },
        xAxis: {
            categories: [
                '',
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
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'N° Provincias'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: ' N° Provincias'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            "name": "> 70",
            "data": [],
            "color": '#002573'
        },
        {
            "name": "60 - 70",
            "data": [],
            "color": '#004c73'
        },
        {
            "name": "50 - 60",
            "data": [],
            "color": '#0084a8'
        },
        {
            "name": "45 - 50",
            "data": [],
            "color": '#329900'
        },
        {
            "name": "40 -45",
            "data": [],
            "color": '#40bf00'
        },
        {
            "name": "35 - 40",
            "data": [],
            "color": '#00a853'
        },
        {
            "name": "30 - 35",
            "data": [],
            "color": '#55ff00'
        },
        {
            "name": "25 - 30",
            "data": [],
            "color": '#aaff02'
        },
        {
            "name": "20 - 25",
            "data": [],
            "color": '#00e6a8'
        },
        {
            "name": "15 -20",
            "data": [],
            "color": '#ffd380'
        },
        {
            "name": "10 - 15",
            "data": [],
            "color": '#ffaa01'
        },
        {
            "name": "5 - 10",
            "data": [],
            "color": '#a87001'
        },
        {
            "name": "0 -5",
            "data": [],
            "color": '#eaeaea'
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
            "data": []
        },
        {
            "name": "Alto",
            "data": []
        },
        {
            "name": "Medio",
            "data": []
        },
        {
            "name": "Bajo",
            "data": []
        },
        {
            "name": "Muy Bajo",
            "data": []
        }]
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
                                <td>${elem.perimetro}</td>
                                <td>${elem.periodo}</td>
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
    $('.panelControl_details .body .header .title').html(`Evapotranspiración de referencia - ${product_grupoNomCorto} ${product_objetoNombreCorto}`);
}

getDetailsProduct();

getHistorialProduct();

getLugaresAfectados();

createMap();

getPresentInfo();

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