<?php

class Historial
{
    public function getAnio($esquema, $tabla)
    {
        $ch = curl_init();

        $url = "http://sia.senamhi.gob.pe:8080/sia/producto/anio/$esquema/$tabla";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return $result;
    }

    public function getMes($esquema, $tabla, $anio)
    {
        $ch = curl_init();

        $url = "http://sia.senamhi.gob.pe:8080/sia/producto/mes/$esquema/$tabla/$anio";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return $result;
    }


    public function getHistorial($esquema, $tabla, $anio, $mes)
    {
        $ch = curl_init();

        $url = "http://sia.senamhi.gob.pe:8080/sia/producto/historial/$esquema/$tabla/$anio/$mes";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return $result;
    }
}
