<?php
class HistorialController
{
    public function getAnioProduct($esquema, $tabla)
    {
        $respuesta = (new Historial)->getAnio($esquema, $tabla);

        if (isset($respuesta) && !isset($respuesta->error)) {
            return $respuesta;
        } else {
            return [];
        }
    }

    public function getMesProduct($esquema, $tabla, $anio)
    {
        $respuesta = (new Historial)->getMes($esquema, $tabla, $anio);

        if (isset($respuesta) && !isset($respuesta->error)) {
            return $respuesta;
        } else {
            return [];
        }
    }
}
