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
            echo '<link rel="stylesheet" href="resources/css/pages/riesgo.css">';
            break;
        case 'evapotranspiracion-1ra':
        case 'evapotranspiracion-2da':
        case 'evapotranspiracion-3ra':
            echo '<link rel="stylesheet" href="resources/css/pages/evapotranspiracion.css">';
            break;

        case 'indice-humedad-1ra':
        case 'indice-humedad-2da':
        case 'indice-humedad-3ra':
            echo '<link rel="stylesheet" href="resources/css/pages/indice-humedad.css">';
            break;

        case 'climatico-pp':
        case 'climatico-tmin':
        case 'climatico-tmax':
            echo '<link rel="stylesheet" href="resources/css/pages/climatico.css">';
            break;
        default:
            echo '<link rel="stylesheet" href="resources/css/pages/404.css">';
    }
} else {
    echo '<link rel="stylesheet" href="resources/css/pages/inicio.css">';
}
