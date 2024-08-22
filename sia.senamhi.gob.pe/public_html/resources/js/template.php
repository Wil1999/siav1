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
            echo '<script src="resources/js/pages/' . $_GET['p'] . '.js"></script>';
            break;
        default:
            echo '<script src="resources/js/pages/404.js"></script>';
    }
} else {
    echo '<script src="resources/js/pages/inicio.js"></script>';
}
