<?php


class UbicacionRiesgoController
{
    public $lugares;

    public $max_leyenda;

    public $leyenda_name = array(
        'Muy Alto',
        'Alto',
        'Medio',
        'Bajo',
        'Muy Bajo'
    );

    public function __construct($lugar_afectado)
    {
        $respuesta = (new UbicacionRiesgo)->get($lugar_afectado);


        $this->lugares = [];
        $this->max_leyenda = '';

        $this->lugares = $respuesta->leyendas;
        $this->max_leyenda = $respuesta->maxLeyenda;
    }

    public function maxLeyenda()
    {
        switch ($this->max_leyenda) {
            case 'Muy Alto':

                return array(
                    'activeMuyAlto' => 'active',
                    'activeAlto' => '',
                    'activeMedio' => '',
                    'activeBajo' => '',
                    'activeMuyBajo' => '',

                    'styleMuyAlto' => 'color: #c9c9c9',
                    'styleAlto' => '',
                    'styleMedio' => '',
                    'styleBajo' => '',
                    'styleMuyBajo' => '',

                    'mostrarMuyAlto' => '',
                    'mostrarAlto' => 'display: none',
                    'mostrarMedio' => 'display: none',
                    'mostrarBajo' => 'display: none',
                    'mostrarMuyBajo' => 'display: none',
                );
                break;
            case 'Alto':

                return array(
                    'activeMuyAlto' => '',
                    'activeAlto' => 'active',
                    'activeMedio' => '',
                    'activeBajo' => '',
                    'activeMuyBajo' => '',

                    'styleMuyAlto' => '',
                    'styleAlto' => 'color: #c9c9c9',
                    'styleMedio' => '',
                    'styleBajo' => '',
                    'styleMuyBajo' => '',

                    'mostrarMuyAlto' => 'display: none',
                    'mostrarAlto' => '',
                    'mostrarMedio' => 'display: none',
                    'mostrarBajo' => 'display: none',
                    'mostrarMuyBajo' => 'display: none',
                );
                break;
            case 'Medio':

                return array(
                    'activeMuyAlto' => '',
                    'activeAlto' => '',
                    'activeMedio' => 'active',
                    'activeBajo' => '',
                    'activeMuyBajo' => '',

                    'styleMuyAlto' => '',
                    'styleAlto' => '',
                    'styleMedio' => 'color: #c9c9c9',
                    'styleBajo' => '',
                    'styleMuyBajo' => '',

                    'mostrarMuyAlto' => 'display: none',
                    'mostrarAlto' => 'display: none',
                    'mostrarMedio' => '',
                    'mostrarBajo' => 'display: none',
                    'mostrarMuyBajo' => 'display: none',
                );
                break;
            case 'Bajo':

                return array(
                    'activeMuyAlto' => '',
                    'activeAlto' => '',
                    'activeMedio' => '',
                    'activeBajo' => 'active',
                    'activeMuyBajo' => '',

                    'styleMuyAlto' => '',
                    'styleAlto' => '',
                    'styleMedio' => '',
                    'styleBajo' => 'color: #c9c9c9',
                    'styleMuyBajo' => '',

                    'mostrarMuyAlto' => 'display: none',
                    'mostrarAlto' => 'display: none',
                    'mostrarMedio' => 'display: none',
                    'mostrarBajo' => '',
                    'mostrarMuyBajo' => 'display: none',
                );
                break;
            case 'Muy Bajo':

                return array(
                    'activeMuyAlto' => '',
                    'activeAlto' => '',
                    'activeMedio' => '',
                    'activeBajo' => '',
                    'activeMuyBajo' => 'active',

                    'styleMuyAlto' => '',
                    'styleAlto' => '',
                    'styleMedio' => '',
                    'styleBajo' => '',
                    'styleMuyBajo' => 'color: #c9c9c9',

                    'mostrarMuyAlto' => 'display: none',
                    'mostrarAlto' => 'display: none',
                    'mostrarMedio' => 'display: none',
                    'mostrarBajo' => 'display: none',
                    'mostrarMuyBajo' => '',
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
            if ($this->lugares[$i]->leyenda == 'Muy Alto') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#" >' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['muy-alto'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['muy-alto'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Alto') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['alto'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['alto'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }


            if ($this->lugares[$i]->leyenda == 'Medio') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['medio'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['medio'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Bajo') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['bajo'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['bajo'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Muy Bajo') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['muy-bajo'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['muy-bajo'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }
        }

        return array(
            'ubicacionDepMuyAlto' => isset($ubicaDev['muy-alto']) ? $ubicaDev['muy-alto'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepAlto' => isset($ubicaDev['alto']) ? $ubicaDev['alto'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepMedio' => isset($ubicaDev['medio']) ? $ubicaDev['medio'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepBajo' => isset($ubicaDev['bajo']) ? $ubicaDev['bajo'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepMuyBajo' => isset($ubicaDev['muy-bajo']) ? $ubicaDev['muy-bajo'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',

            'ubicacionProvMuyAlto' => isset($ubicaProv['muy-alto']) ? $ubicaProv['muy-alto'] : null,
            'ubicacionProvAlto' => isset($ubicaProv['alto']) ? $ubicaProv['alto'] : null,
            'ubicacionProvMedio' => isset($ubicaProv['medio']) ? $ubicaProv['medio'] : null,
            'ubicacionProvBajo' => isset($ubicaProv['bajo']) ? $ubicaProv['bajo'] : null,
            'ubicacionProvMuyBajo' => isset($ubicaProv['muy-bajo']) ? $ubicaProv['muy-bajo'] : null,
        );
    }
}
