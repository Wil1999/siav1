const CENTERLAT = -8.6951786;
const CENTERLONG = -74.9904165;

var imageBounds = [
    [-18.4427947998047, -81.3917770385742],
    [0.0529556907713413, -68.5900115966797],
]

var map = L.map('mapid', {
    preferCanvas: true,
    zoomControl: false
}).setView([CENTERLAT, CENTERLONG], 6);

var tiles = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
    maxZoom: 16
}).addTo(map)


var departamento = L.tileLayer.wms('http://idesep.senamhi.gob.pe:80/geoserver/g_00_02/wms', {
    layers: 'g_00_02:00_02_002_03_000_000_0000_00_00',
    format: 'image/png',
    transparent: true,
    tiled: 'true',
    //retina: '@2x',
    detectRetina: true,
    pane: "departamento"
})

map.createPane("departamento");
departamento.addTo(map);

var bounds = L.latLng(CENTERLONG, CENTERLAT).toBounds(500)


$(window).on('load', function () {
    $('.outer-loader').delay(1000).fadeOut('slow');
});