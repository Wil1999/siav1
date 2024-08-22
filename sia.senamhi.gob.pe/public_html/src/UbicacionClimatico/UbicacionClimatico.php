
<?php

class UbicacionClimatico
{
    public function get($lugar_afectado)
    {
        $ch = curl_init();

        $url = 'http://sia.senamhi.gob.pe:8080/lugaresAfectados/' . $lugar_afectado . '.json';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return $result;
    }
}
