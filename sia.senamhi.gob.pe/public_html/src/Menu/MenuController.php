<?php

class MenuController
{
    public $temas = array('03', '04', '11');
    public $grupo = array(
        '03' => array(
            '02'
        ),
        '04' => array(
            '06',
            '07'
        ),
        '11' => array(
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
        ),
    );
    public $objeto = array(
        '03' => array(
            '02' => array('001', '002', '003')
        ),
        '04' => array(
            '06' => array('001', '002', '003'),
            '07' => array('001', '002', '003')
        ),
        '11' => array(
            '01' => array('001'),
            '02' => array('001'),
            '03' => array('001'),
            '04' => array('001'),
            '05' => array('001'),
            '06' => array('001'),
            '07' => array('001'),
            '08' => array('001'),
            '09' => array('001'),
            '10' => array('001'),
        ),
    );

    public $links = array(
        '202' => '?p=climatico-pp',
        '205' => '?p=climatico-tmin',
        '206' => '?p=climatico-tmax',
        '47' => '?p=evapotranspiracion-1ra',
        '48' => '?p=evapotranspiracion-2da',
        '49' => '?p=evapotranspiracion-3ra',
        '76' => '?p=indice-humedad-1ra',
        '77' => '?p=indice-humedad-2da',
        '78' => '?p=indice-humedad-3ra',
        '350' => '?p=riesgo-arroz',
        '352' => '?p=riesgo-maiz',
        '353' => '?p=riesgo-papa',
        '354' => '?p=riesgo-cacao',
        '355' => '?p=riesgo-cafe',
        '591' => '?p=riesgo-pasto',
        '1186' => '?p=riesgo-quinua',
        '1187' => '?p=riesgo-palto',
        '1188' => '?p=riesgo-cebolla',
        '1189' => '?p=riesgo-frijol',
    );

    public function list()
    {
        $jsonFeatures = array();
        $jsonFeatures2 = array();
        $jsonFeatures3 = array();
        $uniquekeys = array();
        $uniquekeys2 = array();
        $uniquekeys3 = array();

        $respuesta = (new Menu)->getAll();

        if (isset($respuesta)) {
            foreach ($respuesta as $item) {
                if (!in_array($item->codtema, $uniquekeys)) {
                    if (in_array($item->codtema, $this->temas)) {
                        $uniquekeys[] = $item->codtema;
                        $jsonFeatures[]     =  (object)array(
                            'id' => $item->id,
                            'codtema' => $item->codtema,
                            'temaNomCorto' => $item->temaNomCorto,
                        );
                    }
                }
            }

            foreach ($jsonFeatures as $group) {
                foreach ($respuesta as $item) {
                    if ($group->codtema == $item->codtema) {
                        if (!in_array("$item->codtema-$item->codgrupo", $uniquekeys2)) {
                            if (in_array($item->codgrupo, $this->grupo[$item->codtema])) {
                                $uniquekeys2[] = "$item->codtema-$item->codgrupo";
                                $jsonFeatures2[]     =  (object)array(
                                    'id' => $item->id,
                                    'codtema' => $item->codtema,
                                    'temaNomCorto' => $item->temaNomCorto,
                                    'codgrupo' => $item->codgrupo,
                                    'grupoNomCorto' => $item->grupoNomCorto,
                                );
                            }
                        }
                    }
                }
            }

            array_multisort(
                array_column($jsonFeatures2, 'codtema'),
                SORT_ASC,
                array_column($jsonFeatures2, 'codgrupo'),
                SORT_ASC,
                $jsonFeatures2
            );

            foreach ($jsonFeatures2 as $group) {
                foreach ($respuesta as $item) {
                    if ($group->codtema == $item->codtema) {
                        if ($group->codgrupo == $item->codgrupo) {
                            if (!in_array($item->id, $uniquekeys3)) {
                                if (in_array($item->codObjeto, $this->objeto[$item->codtema][$item->codgrupo])) {
                                    $item->linkWeb = $this->links[$item->id] ?? '';
                                    $uniquekeys3[] = $item->id;
                                    $jsonFeatures3[]     =  $item;
                                }
                            }
                        }
                    }
                }
            }

            array_multisort(
                array_column($jsonFeatures3, 'codtema'),
                SORT_ASC,
                array_column($jsonFeatures3, 'codgrupo'),
                SORT_ASC,
                $jsonFeatures3
            );

            $respuesta = array(
                'temas' => $jsonFeatures,
                'grupos' => $jsonFeatures2,
                'objetos' => $jsonFeatures3,
            );

            return $respuesta;
        } else {
            return $respuesta = [];
        }
    }

    public function infoProduct($products, $page)
    {
        $respuesta = [];

        for ($i = 0; $i < count($products); $i++) {
            $url = $this->links[$products[$i]->id] ?? '';
            if (strpos($url, $page) !== false) {

                $lyrArr = explode(':', $products[$i]->layerWms);
                $esquema = 'db' . explode('_', $lyrArr[0])[1];
                $tabla = str_replace('_', '.', $lyrArr[1]);
                $lugaresAfectados = $esquema . '_' . $lyrArr[1];

                $_SESSION['urlWms'] = $products[$i]->urlWms;
                $_SESSION['layerWms'] = $products[$i]->layerWms;
                $_SESSION['esquema'] = $esquema;
                $_SESSION['tabla'] = $tabla;
                $_SESSION['lugaresAfectados'] = $lugaresAfectados;
                $_SESSION['lugaresAfectados'] = $lugaresAfectados;

                $respuesta = array(
                    'grupoNomCorto' => $products[$i]->grupoNomCorto,
                    'objetoNombreCorto' => $products[$i]->objetoNombreCorto,
                    'urlWms' => $products[$i]->urlWms,
                    'layerWms' => $products[$i]->layerWms,
                    'esquema' => $esquema,
                    'tabla' => $tabla,
                    'lugaresAfectados' => $lugaresAfectados,
                );
            }
        }

        return $respuesta;
    }
}
