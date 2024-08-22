<?php

class UbicacionMonitoreoController
{
    public $lugares;

    public $max_leyenda;

    public $leyenda_name = array(
        'Deficiencia Extrema',
        'Deficiencia Ligera',
        'Adecuado',
        'Exceso Ligero',
        'Exceso Extremo'
    );

    public function __construct($lugar_afectado)
    {
        $respuesta = (new UbicacionMonitoreo)->get($lugar_afectado);


        $this->lugares = [];
        $this->max_leyenda = '';

        $this->lugares = $respuesta->leyendas;
        $this->max_leyenda = $respuesta->maxLeyenda;
    }

    public function maxLeyenda()
    {
        switch ($this->max_leyenda) {
            case 'Deficiencia Extrema':
                return array(
                    'activeDeficienciaExtrema' => 'active',
                    'activeDeficienciaLigera' => '',
                    'activeAdecuado' => '',
                    'activeExcesoLigero' => '',
                    'activeExcesoExtremo' => '',

                    'styleDeficienciaExtrema' => 'color: #c9c9c9',
                    'styleDeficienciaLigera' => '',
                    'styleAdecuado' => '',
                    'styleExcesoLigero' => '',
                    'styleExcesoExtremo' => '',

                    'mostrarDeficienciaExtrema' => '',
                    'mostrarDeficienciaLigera' => 'display: none',
                    'mostrarAdecuado' => 'display: none',
                    'mostrarExcesoLigero' => 'display: none',
                    'mostrarExcesoExtremo' => 'display: none',
                );
                break;

            case 'Deficiencia Ligera':
                return array(
                    'activeDeficienciaExtrema' => '',
                    'activeDeficienciaLigera' => 'active',
                    'activeAdecuado' => '',
                    'activeExcesoLigero' => '',
                    'activeExcesoExtremo' => '',

                    'styleDeficienciaExtrema' => '',
                    'styleDeficienciaLigera' => 'color: #c9c9c9',
                    'styleAdecuado' => '',
                    'styleExcesoLigero' => '',
                    'styleExcesoExtremo' => '',

                    'mostrarDeficienciaExtrema' => 'display: none',
                    'mostrarDeficienciaLigera' => '',
                    'mostrarAdecuado' => 'display: none',
                    'mostrarExcesoLigero' => 'display: none',
                    'mostrarExcesoExtremo' => 'display: none',
                );
                break;

            case 'Adecuado':
                return array(
                    'activeDeficienciaExtrema' => '',
                    'activeDeficienciaLigera' => '',
                    'activeAdecuado' => 'active',
                    'activeExcesoLigero' => '',
                    'activeExcesoExtremo' => '',

                    'styleDeficienciaExtrema' => '',
                    'styleDeficienciaLigera' => '',
                    'styleAdecuado' => 'color: #c9c9c9',
                    'styleExcesoLigero' => '',
                    'styleExcesoExtremo' => '',

                    'mostrarDeficienciaExtrema' => 'display: none',
                    'mostrarDeficienciaLigera' => 'display: none',
                    'mostrarAdecuado' => '',
                    'mostrarExcesoLigero' => 'display: none',
                    'mostrarExcesoExtremo' => 'display: none',
                );
                break;

            case 'Exceso Ligero':
                return array(
                    'activeDeficienciaExtrema' => '',
                    'activeDeficienciaLigera' => '',
                    'activeAdecuado' => '',
                    'activeExcesoLigero' => 'active',
                    'activeExcesoExtremo' => '',

                    'styleDeficienciaExtrema' => '',
                    'styleDeficienciaLigera' => '',
                    'styleAdecuado' => '',
                    'styleExcesoLigero' => 'color: #c9c9c9',
                    'styleExcesoExtremo' => '',

                    'mostrarDeficienciaExtrema' => 'display: none',
                    'mostrarDeficienciaLigera' => 'display: none',
                    'mostrarAdecuado' => 'display: none',
                    'mostrarExcesoLigero' => '',
                    'mostrarExcesoExtremo' => 'display: none',
                );
                break;

            case 'Exceso Extremo':
                return array(
                    'activeDeficienciaExtrema' => '',
                    'activeDeficienciaLigera' => '',
                    'activeAdecuado' => '',
                    'activeExcesoLigero' => '',
                    'activeExcesoExtremo' => 'active',

                    'styleDeficienciaExtrema' => '',
                    'styleDeficienciaLigera' => '',
                    'styleAdecuado' => '',
                    'styleExcesoLigero' => '',
                    'styleExcesoExtremo' => 'color: #c9c9c9',

                    'mostrarDeficienciaExtrema' => 'display: none',
                    'mostrarDeficienciaLigera' => 'display: none',
                    'mostrarAdecuado' => 'display: none',
                    'mostrarExcesoLigero' => 'display: none',
                    'mostrarExcesoExtremo' => '',
                );
                break;
        }
    }

    public function ubicacionDepProv()
    {
        $format = (new Format);

        $dataDev = '';
        $dataProv = '';
        $ubicaDev = array();
        $ubicaProv = array();
        for ($i = 0; $i < count($this->lugares); $i++) {
            if ($this->lugares[$i]->leyenda == 'Deficiencia Extrema') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#" >' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['deficiencia-extrema'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['deficiencia-extrema'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Deficiencia Ligera') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['deficiencia-ligera'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['deficiencia-ligera'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }


            if ($this->lugares[$i]->leyenda == 'Adecuado') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['adecuado'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['adecuado'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Exceso Ligero') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['exceso-ligero'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['exceso-ligero'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Exceso Extremo') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['exceso-extremo'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['exceso-extremo'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }
        }

        return array(
            'ubicacionDepDeficienciaExtrema' => isset($ubicaDev['deficiencia-extrema']) ? $ubicaDev['deficiencia-extrema'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepDeficienciaLigera' => isset($ubicaDev['deficiencia-ligera']) ? $ubicaDev['deficiencia-ligera'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepAdecuado' => isset($ubicaDev['adecuado']) ? $ubicaDev['adecuado'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepExcesoLigero' => isset($ubicaDev['exceso-ligero']) ? $ubicaDev['exceso-ligero'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepExcesoExtremo' => isset($ubicaDev['exceso-extremo']) ? $ubicaDev['exceso-extremo'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',

            'ubicacionProvDeficienciaExtrema' => isset($ubicaProv['deficiencia-extrema']) ? $ubicaProv['deficiencia-extrema'] : null,
            'ubicacionProvDeficienciaLigera' => isset($ubicaProv['deficiencia-ligera']) ? $ubicaProv['deficiencia-ligera'] : null,
            'ubicacionProvAdecuado' => isset($ubicaProv['adecuado']) ? $ubicaProv['adecuado'] : null,
            'ubicacionProvExcesoLigero' => isset($ubicaProv['exceso-ligero']) ? $ubicaProv['exceso-ligero'] : null,
            'ubicacionProvExcesoExtremo' => isset($ubicaProv['exceso-extremo']) ? $ubicaProv['exceso-extremo'] : null,
        );
    }
}
