<?php

class UbicacionEvapotranspiracionController
{
    public $lugares;

    public $max_leyenda;

    public $leyenda_name = array(
        '> 70',
        '60 - 70',
        '50 - 60',
        '45 - 50',
        '40 - 45',
        '35 - 40',
        '30 - 35',
        '25 - 30',
        '20 - 25',
        '15 - 20',
        '10 - 15',
        '5 - 10',
        '0 - 5',
    );

    public function __construct($lugar_afectado)
    {
        $respuesta = (new UbicacionEvapotranspiracion)->get($lugar_afectado);


        $this->lugares = [];
        $this->max_leyenda = '';

        $this->lugares = $respuesta->leyendas;
        $this->max_leyenda = $respuesta->maxLeyenda;
    }

    public function maxLeyenda()
    {
        switch ($this->max_leyenda) {
            case '> 70':
                return array(
                    'activeMayor70' => 'active',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => 'color: #c9c9c9',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => '',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '60 - 70':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => 'active',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => 'color: #c9c9c9',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => '',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '50 - 60':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => 'active',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => 'color: #c9c9c9',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => '',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '45 - 50':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => 'active',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => 'color: #c9c9c9',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => '',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '40 - 45':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => 'active',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => 'color: #c9c9c9',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => '',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '35 - 40':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => 'active',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => 'color: #c9c9c9',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => '',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '30 - 35':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => 'active',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => 'color: #c9c9c9',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => '',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '25 - 30':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => 'active',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => 'color: #c9c9c9',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => '',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '20 - 25':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => 'active',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => 'color: #c9c9c9',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => '',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '15 - 20':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => 'active',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => 'color: #c9c9c9',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => '',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '10 - 15':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => 'active',
                    'active5-10' => '',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => 'color: #c9c9c9',
                    'style5-10' => '',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => '',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '5 - 10':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => 'active',
                    'active0-5' => '',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => 'color: #c9c9c9',
                    'style0-5' => '',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => '',
                    'mostrar0-5' => 'display: none',
                );
                break;

            case '0 - 5':
                return array(
                    'activeMayor70' => '',
                    'active60-70' => '',
                    'active50-60' => '',
                    'active45-50' => '',
                    'active40-45' => '',
                    'active35-40' => '',
                    'active30-35' => '',
                    'active25-30' => '',
                    'active20-25' => '',
                    'active15-20' => '',
                    'active10-15' => '',
                    'active5-10' => '',
                    'active0-5' => 'active',

                    'styleMayor70' => '',
                    'style60-70' => '',
                    'style50-60' => '',
                    'style45-50' => '',
                    'style40-45' => '',
                    'style35-40' => '',
                    'style30-35' => '',
                    'style25-30' => '',
                    'style20-25' => '',
                    'style15-20' => '',
                    'style10-15' => '',
                    'style5-10' => '',
                    'style0-5' => 'color: #c9c9c9',

                    'mostrarMayor70' => 'display: none',
                    'mostrar60-70' => 'display: none',
                    'mostrar50-60' => 'display: none',
                    'mostrar45-50' => 'display: none',
                    'mostrar40-45' => 'display: none',
                    'mostrar35-40' => 'display: none',
                    'mostrar30-35' => 'display: none',
                    'mostrar25-30' => 'display: none',
                    'mostrar20-25' => 'display: none',
                    'mostrar15-20' => 'display: none',
                    'mostrar10-15' => 'display: none',
                    'mostrar5-10' => 'display: none',
                    'mostrar0-5' => '',
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
            if ($this->lugares[$i]->leyenda == '> 70') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#" >' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['mayor-70'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['mayor-70'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '60 - 70') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['60-70'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['60-70'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }


            if ($this->lugares[$i]->leyenda == '50 - 60') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['50-60'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['50-60'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '45 - 50') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['45-50'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['45-50'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '40 - 45') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['40-45'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['40-45'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '35 - 40') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#" >' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['35-40'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['35-40'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '30 - 35') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['30-35'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['30-35'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }


            if ($this->lugares[$i]->leyenda == '25 - 30') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['25-30'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['25-30'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '20 - 25') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['20-25'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['20-25'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '15 - 20') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['15-20'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['15-20'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '10 - 15') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['10-15'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['10-15'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '5 - 10') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['5-10'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['5-10'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }

            if ($this->lugares[$i]->leyenda == '0 - 5') {
                for ($y = 0; $y < count($this->lugares[$i]->dep); $y++) {
                    $dataDev .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '" class="text-light depBuscarZoom" href="#">' . utf8_encode($this->lugares[$i]->dep[$y]->nomdep) . '</a>, ';

                    $nomProv = '';

                    for ($x = 0; $x < count($this->lugares[$i]->dep[$y]->prov); $x++) {

                        $nomProv = utf8_encode(utf8_decode($this->lugares[$i]->dep[$y]->prov[$x]->nomprov)) . ', ';
                        $cleanNameProv = $format->elminar_acentos(mb_strtolower(substr(trim($nomProv), 0, -1)));;

                        $dataProv .= '<a id="' . preg_replace('#\s+#', '-', mb_strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . '_' . preg_replace('#\s+#', '-', $cleanNameProv) . '" class="dep_' . preg_replace('#\s+#', '-', strtolower(trim($this->lugares[$i]->dep[$y]->nomdep))) . ' depTotales text-light d-none" href="#">' . substr(trim($nomProv), 0, -1) . ', </a>';
                    }
                }

                $ubicaDev['0-5'] = substr(trim($dataDev), 0, -1);
                $ubicaProv['0-5'] = substr(trim($dataProv), 0, -1);
                $dataDev = '';
                $dataProv = '';
            }
        }

        return array(
            'ubicacionDepMayor70' => isset($ubicaDev['mayor-70']) ? $ubicaDev['mayor-70'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep60-70' => isset($ubicaDev['60-70']) ? $ubicaDev['60-70'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep50-60' => isset($ubicaDev['50-60']) ? $ubicaDev['50-60'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep45-50' => isset($ubicaDev['45-50']) ? $ubicaDev['45-50'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep40-45' => isset($ubicaDev['40-45']) ? $ubicaDev['40-45'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep35-40' => isset($ubicaDev['35-40']) ? $ubicaDev['35-40'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep30-35' => isset($ubicaDev['30-35']) ? $ubicaDev['30-35'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep25-30' => isset($ubicaDev['25-30']) ? $ubicaDev['25-30'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep20-25' => isset($ubicaDev['20-25']) ? $ubicaDev['20-25'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep15-20' => isset($ubicaDev['15-20']) ? $ubicaDev['15-20'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep10-15' => isset($ubicaDev['10-15']) ? $ubicaDev['10-15'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep5-10' => isset($ubicaDev['5-10']) ? $ubicaDev['5-10'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',
            'ubicacionDep0-5' => isset($ubicaDev['0-5']) ? $ubicaDev['0-5'] : '<a class="text-light">No se encontraron departamentos afectados.</a>',

            'ubicacionProvMayor70' => isset($ubicaProv['mayor-70']) ? $ubicaProv['mayor-70'] : null,
            'ubicacionProv60-70' => isset($ubicaProv['60-70']) ? $ubicaProv['60-70'] : null,
            'ubicacionProv50-60' => isset($ubicaProv['50-60']) ? $ubicaProv['50-60'] : null,
            'ubicacionProv45-50' => isset($ubicaProv['45-50']) ? $ubicaProv['45-50'] : null,
            'ubicacionProv40-45' => isset($ubicaProv['40-45']) ? $ubicaProv['40-45'] : null,
            'ubicacionProv35-40' => isset($ubicaProv['35-40']) ? $ubicaProv['35-40'] : null,
            'ubicacionProv30-35' => isset($ubicaProv['30-35']) ? $ubicaProv['30-35'] : null,
            'ubicacionProv25-30' => isset($ubicaProv['25-30']) ? $ubicaProv['25-30'] : null,
            'ubicacionProv20-25' => isset($ubicaProv['20-25']) ? $ubicaProv['20-25'] : null,
            'ubicacionProv15-20' => isset($ubicaProv['15-20']) ? $ubicaProv['15-20'] : null,
            'ubicacionProv10-15' => isset($ubicaProv['10-15']) ? $ubicaProv['10-15'] : null,
            'ubicacionProv5-10' => isset($ubicaProv['5-10']) ? $ubicaProv['5-10'] : null,
            'ubicacionProv0-5' => isset($ubicaProv['0-5']) ? $ubicaProv['0-5'] : null,
        );
    }
}
