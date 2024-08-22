<?php

class Component
{
    public static function view($file)
    {
        switch ($file) {
            case 'table-nivel':
            case 'filter-nivel':
            case 'filter-dev-prov':
            case 'historial-riesgo':
                include 'resources/components/riesgo-agroclimatico/' . $file . '.php';
                break;
            case 'table-rango-evapotranspiracion':
            case 'filter-rango-evapotranspiracion':
            case 'historial-rango-evapotranspiracion':
                include 'resources/components/monitoreo/evapotranspiracion/' . $file . '.php';
                break;
            case 'table-rango-indice-humedad':
            case 'filter-rango-indice-humedad':
            case 'historial-rango-indice-humedad':
                include 'resources/components/monitoreo/indice-humedad/' . $file . '.php';
                break;
            case 'table-escenario-climatico':
            case 'filter-escenario-climatico':
            case 'historial-escenario-climatico':
                include 'resources/components/pronostico/climatico/' . $file . '.php';
                break;
        }
    }
}
