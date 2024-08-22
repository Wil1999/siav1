<?php

if (isset($_GET['p'])) {
    switch ($_GET['p']) {
        case 'inicio':
        case 'riesgo-arroz':
        case 'riesgo-maiz':
        case 'riesgo-papa':
        case 'riesgo-cacao':
        case 'riesgo-cafe':
        case 'riesgo-pasto':
        case 'riesgo-quinua':
        case 'riesgo-palto':
        case 'riesgo-cebolla':
        case 'riesgo-frijol':

        case 'evapotranspiracion-1ra':
        case 'evapotranspiracion-2da':
        case 'evapotranspiracion-3ra':

        case 'indice-humedad-1ra':
        case 'indice-humedad-2da':
        case 'indice-humedad-3ra':

        case 'climatico-pp':
        case 'climatico-tmin':
        case 'climatico-tmax':
            include 'resources/pages/' . $_GET['p'] . '.php';
            break;
        default:
            include 'resources/pages/404.php';
    }
} else {
    include 'resources/pages/inicio.php';
}
