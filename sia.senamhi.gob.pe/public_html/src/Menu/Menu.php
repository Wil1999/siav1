<?php

class Menu
{
    public function getAll()
    {
        $ch = curl_init();

        $url = 'https://idesep.senamhi.gob.pe/servicios/list';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return $result;
    }
}
