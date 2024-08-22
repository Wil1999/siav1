<?php

class UbicacionClimaticoController
{
    public $lugares;

    public $max_leyenda;

    public $leyenda_name = array(
        'Sobre lo Normal',
        'Normal',
        'Bajo lo Normal',
        'No Significativo Estadisticamente',
        'Periodo Seco'
    );

    public function __construct($lugar_afectado)
    {
        $respuesta = (new UbicacionClimatico)->get($lugar_afectado);


        $this->lugares = [];
        $this->max_leyenda = '';

        $this->lugares = $respuesta->leyendas;
        $this->max_leyenda = $respuesta->maxLeyenda;
    }

    public function maxLeyenda()
    {
        switch ($this->max_leyenda) {
            case 'Sobre lo Normal':

                return array(
                    'activeSobreNormal' => 'active',
                    'activeNormal' => '',
                    'activeBajoNormal' => '',
                    'activeNoSignificativoEstadisticamente' => '',
                    'activePeriodoSeco' => '',

                    'styleSobreNormal' => 'color: #c9c9c9',
                    'styleNormal' => '',
                    'styleBajoNormal' => '',
                    'styleNoSignificativoEstadisticamente' => '',
                    'stylePeriodoSeco' => '',

                    'mostrarSobreNormal' => '',
                    'mostrarNormal' => 'display: none',
                    'mostrarBajoNormal' => 'display: none',
                    'mostrarNoSignificativoEstadisticamente' => 'display: none',
                    'mostrarPeriodoSeco' => 'display: none',
                );
                break;
            case 'Normal':

                return array(
                    'activeSobreNormal' => '',
                    'activeNormal' => 'active',
                    'activeBajoNormal' => '',
                    'activeNoSignificativoEstadisticamente' => '',
                    'activePeriodoSeco' => '',

                    'styleSobreNormal' => '',
                    'styleNormal' => 'color: #c9c9c9',
                    'styleBajoNormal' => '',
                    'styleNoSignificativoEstadisticamente' => '',
                    'stylePeriodoSeco' => '',

                    'mostrarSobreNormal' => 'display: none',
                    'mostrarNormal' => '',
                    'mostrarBajoNormal' => 'display: none',
                    'mostrarNoSignificativoEstadisticamente' => 'display: none',
                    'mostrarPeriodoSeco' => 'display: none',
                );
                break;
            case 'Bajo lo Normal':

                return array(
                    'activeSobreNormal' => '',
                    'activeNormal' => '',
                    'activeBajoNormal' => 'active',
                    'activeNoSignificativoEstadisticamente' => '',
                    'activePeriodoSeco' => '',

                    'styleSobreNormal' => '',
                    'styleNormal' => '',
                    'styleBajoNormal' => 'color: #c9c9c9',
                    'styleNoSignificativoEstadisticamente' => '',
                    'stylePeriodoSeco' => '',

                    'mostrarSobreNormal' => 'display: none',
                    'mostrarNormal' => 'display: none',
                    'mostrarBajoNormal' => '',
                    'mostrarNoSignificativoEstadisticamente' => 'display: none',
                    'mostrarPeriodoSeco' => 'display: none',
                );
                break;
            case 'No Significativo Estadisticamente':

                return array(
                    'activeSobreNormal' => '',
                    'activeNormal' => '',
                    'activeBajoNormal' => '',
                    'activeNoSignificativoEstadisticamente' => 'active',
                    'activePeriodoSeco' => '',

                    'styleSobreNormal' => '',
                    'styleNormal' => '',
                    'styleBajoNormal' => '',
                    'styleNoSignificativoEstadisticamente' => 'color: #c9c9c9',
                    'stylePeriodoSeco' => '',

                    'mostrarSobreNormal' => 'display: none',
                    'mostrarNormal' => 'display: none',
                    'mostrarBajoNormal' => 'display: none',
                    'mostrarNoSignificativoEstadisticamente' => '',
                    'mostrarPeriodoSeco' => 'display: none',
                );
                break;
            case 'Periodo Seco':

                return array(
                    'activeSobreNormal' => '',
                    'activeNormal' => '',
                    'activeBajoNormal' => '',
                    'activeNoSignificativoEstadisticamente' => '',
                    'activePeriodoSeco' => 'active',

                    'styleSobreNormal' => '',
                    'styleNormal' => '',
                    'styleBajoNormal' => '',
                    'styleNoSignificativoEstadisticamente' => '',
                    'stylePeriodoSeco' => 'color: #c9c9c9',

                    'mostrarSobreNormal' => 'display: none',
                    'mostrarNormal' => 'display: none',
                    'mostrarBajoNormal' => 'display: none',
                    'mostrarNoSignificativoEstadisticamente' => 'display: none',
                    'mostrarPeriodoSeco' => '',
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
            if ($this->lugares[$i]->leyenda == 'Sobre lo Normal') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#" >' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['sobre-normal'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['sobre-normal'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Normal') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['normal'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['normal'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }


            if ($this->lugares[$i]->leyenda == 'Bajo lo Normal') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['bajo-normal'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['bajo-normal'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'No Significativo Estadisticamente') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['no-significativo-estadisticamente'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['no-significativo-estadisticamente'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == 'Periodo Seco') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['periodo-seco'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['periodo-seco'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }
        }

        return array(
            'ubicacionDepSobreNormal' => isset($ubicaDev['sobre-normal']) ? $ubicaDev['sobre-normal'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepNormal' => isset($ubicaDev['normal']) ? $ubicaDev['normal'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepBajoNormal' => isset($ubicaDev['bajo-normal']) ? $ubicaDev['bajo-normal'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepNoSignificativoEstadisticamente' => isset($ubicaDev['no-significativo-estadisticamente']) ? $ubicaDev['no-significativo-estadisticamente'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDepPeriodoSeco' => isset($ubicaDev['periodo-seco']) ? $ubicaDev['periodo-seco'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',

            'ubicacionProvSobreNormal' => isset($ubicaProv['sobre-normal']) ? $ubicaProv['sobre-normal'] : null,
            'ubicacionProvNormal' => isset($ubicaProv['normal']) ? $ubicaProv['normal'] : null,
            'ubicacionProvBajoNormal' => isset($ubicaProv['bajo-normal']) ? $ubicaProv['bajo-normal'] : null,
            'ubicacionProvNoSignificativoEstadisticamente' => isset($ubicaProv['no-significativo-estadisticamente']) ? $ubicaProv['no-significativo-estadisticamente'] : null,
            'ubicacionProvPeriodoSeco' => isset($ubicaProv['periodo-seco']) ? $ubicaProv['periodo-seco'] : null,
        );
    }
}
