<?php

$page = isset($_GET['p']) ? $_GET['p'] : 'incio';
$menu = (new MenuController)->list();


$info = (new MenuController)->infoProduct($menu['objetos'], $page);
/*echo "<pre>";
print_r($menu);
echo "</pre>";*/

$format = (new Format);
$historialInfo = (new HistorialController);

$esquemaInfo = isset($info['esquema']) ? $info['esquema'] : '';
$tablaInfo = isset($info['tabla']) ? $info['tabla'] : '';

$anioDefaultProduct = $historialInfo->getAnioProduct($esquemaInfo, $tablaInfo);
$mesDefaultProduct = $historialInfo->getMesProduct($esquemaInfo, $tablaInfo, !empty($anioDefaultProduct) ? max($anioDefaultProduct) : '');
?>
<!-- MENU -->
<div class="site-menu">
    <div class="nav-menu">
        <div class="c-item-contents">
            <div class="c-item-contents__titles">
                <ul style="padding-left: unset;">
                    <?php foreach ($menu['temas'] as $key => $tema) : ?>
                        <li>
                            <a id="<?= preg_replace('#\s+#', '-', mb_strtolower(trim($tema->temaNomCorto))) ?>" href="#" aria-current="page" class="temaMenuSelect nuxt-link-exact-active nuxt-link-active">
                                <div class="d-flex">
                                    <?= $tema->temaNomCorto ?>
                                </div>
                                <i class="material-icons" style="color: #222e44; padding-left: 1rem;">keyboard_arrow_down</i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="c-item-contents__subtitles grupoMenuBox" style="display: none;">
                <div class="title" style="display: none;">CATEGORÍAS</div>
                <ul style="padding-left: unset;">
                    <?php for ($i = 0; $i < count($menu['grupos']); $i++) : ?>
                        <li id="<?= $format->text(preg_replace('#\s+#', '-', mb_strtolower(trim($menu['grupos'][$i]->temaNomCorto))) . '_' . preg_replace('#\s+#', '-', mb_strtolower(trim($menu['grupos'][$i]->grupoNomCorto)))) ?>" class="tema_<?= preg_replace('#\s+#', '-', mb_strtolower(trim($menu['grupos'][$i]->temaNomCorto))) ?> grupoMenuTotal" style="display: none;">
                            <a href="#" class="">
                                <div class="d-flex">
                                    <?= trim($menu['grupos'][$i]->grupoNomCorto) ?>
                                </div>
                                <i class="material-icons" style="color: #222e44; padding-left: 1rem;">keyboard_arrow_down</i>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
            <div class="c-item-contents__subsubtitles objetoMenuBox" style="display: none;">
                <div class="title" style="display: none;">SUB - CATEGORÍAS</div>
                <ul style="padding-left: unset;">
                    <?php for ($i = 0; $i < count($menu['objetos']); $i++) : ?>
                        <li id="<?= $format->text(preg_replace('#\s+#', '-', mb_strtolower(trim($menu['objetos'][$i]->grupoNomCorto))) . '_' . preg_replace('#\s+#', '-', mb_strtolower(trim($menu['objetos'][$i]->objetoNombreCorto)))) ?>" class="grupo_<?= $format->text(preg_replace('#\s+#', '-', mb_strtolower(trim($menu['objetos'][$i]->grupoNomCorto)))) ?> objetoMenuTotal" style="display: none;">
                            <a href="<?= $menu['objetos'][$i]->linkWeb ?>"><?= trim($menu['objetos'][$i]->objetoNombreCorto) ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- MENU --> 
<input style="display: none;" type="hidden" id="product_grupoNomCorto" value="<?= isset($info['grupoNomCorto']) ? (strpos($info['grupoNomCorto'], 'Evapotrans') !== false ? 'Evapotranspiración Potencial (ETO)' : (strpos($info['grupoNomCorto'], 'Humedad') !== false ? 'Índice de Humedad (IH)' : '')) : '' ?>" />
<input style="display: none;" type="hidden" id="product_objetoNombreCorto" value="<?= isset($info['objetoNombreCorto']) ? $info['objetoNombreCorto'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_urlWms" value="<?= isset($info['urlWms'])  ? $info['urlWms'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_layerWms" value="<?= isset($info['layerWms'])  ? $info['layerWms'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_esquema" value="<?= isset($info['esquema'])  ? $info['esquema'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_tabla" value="<?= isset($info['tabla'])  ? $info['tabla'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_lugaresAfectados" value="<?= isset($info['lugaresAfectados'])  ? $info['lugaresAfectados'] : '' ?>" />
<input style="display: none;" type="hidden" id="product_page" value="<?= $page ?>" />
<input style="display: none;" type="hidden" id="product_anio" value="<?= !empty($anioDefaultProduct) ? max($anioDefaultProduct) : '' ?>" />
<input style="display: none;" type="hidden" id="product_mes" value="<?= !empty($mesDefaultProduct) ? max($mesDefaultProduct) : '' ?>" />

<div id="aboutUsPanel" class="modalServices_menu">
    <div class="modal">
        <div class="body">
            <div class="closeBox">
                <div class="close-button" onclick="toogleAboutUs()">
                    <i class="material-icons">close</i>
                </div>
            </div>
            <div class="menu">
                <h2>Mas información acerca del Sistema de Información Agrometeorológica (SIA)</h2>
                <p>
                    Esta plataforma web es un esfuerzo conjunto entre el Servicio Nacional de Meteorología e Hidrología del Perú (SENAMHI) y la Organización No Gubernamental The Save The Childrens Perú para incidir en la gestión de los riesgos, mejorar el aprovechamiento de los recursos climáticos locales y la adaptación al cambio climático del sector agrario lo que repercutirá en una mayor competitividad de las actividades agropecuarias, mejorar la seguridad alimentaria, la economía y los ingresos económicos de la población rural. En esta plataforma, los usuarios podrán encontrar información agrometeorológica confiable y oportuna para que puedan tomar una decisión informada sobre el clima para sus actividades diarias (corto plazo), así como la planificación de las próximas siembras (mediano plazo).
                </p>
                <p>
                    En una primera etapa del SIA, los productores y los tomadores de decisión podrán disponer e interactuar con los pronósticos de la temperatura máxima, temperatura mínima y precipitación de los próximos tres meses (trimestral) de manera ágil y dinámica, lo que ayudará planificar mejor sus siembras de la campaña agrícola y optar por las mejores opciones.
                </p>
                <p>
                    Asimismo, en base a la red de estaciones de SENAMHI, los usuarios podrán encontrar información de monitoreo de algunos índices agrometeorológicos como la evapotranspiración potencial (ETO) y el índice de humedad (IH), indicadores de las condiciones ambientales favorables para la actividad vegetativa de los cultivos. Esta información le ayudará de manera ágil realizar el seguimiento permanente en su localida, si la atmósfera y la disponibilidad hídrica van acorde a las necesidades de su cultivo, lo que permitirá que sus actividades agrícolas y pecuarias sean más efectivas y oportunas para el desempeño agronómico de las plantas cultivadas y las crianzas.
                </p>
                <p>
                    Asimismo, para los principales cultivos de seguridad alimentaria y de importancia económica como papa, maíz, arroz, quinua y otros, se pone a disposición de los productores agrarios los pronósticos de riesgo agroclimático con un horizonte de tres meses a paso mensual. Esta información utiliza los pronósticos mensuales del clima para estimar y prever los probables riesgos asociados al clima en su localidad durante los próximos meses, permitiendo tomar medidas preventivas más acertadas y efectivas ante los eventos climáticos previstos y mitigar los posibles daños al cultivo y las crianzas.
                </p>
                <div>
                    <h3>Un proyecto realizado por:</h3>
                    <div>
                        <img src="https://www.senamhi.gob.pe/public/images/logo-senamhi.svg" alt="Logotipo SENAMHI">
                        <img src="https://idesep.senamhi.gob.pe/balance-hidrico/assets/img/sidebar/minam.svg" alt="Ministerio del Ambiente">
                    </div>
                </div>

                <div>
                    <h3>Con el financiamiento de:</h3>
                    <div>
                        <img src="./public/assets/img/start-fund-clean.svg" alt="Logotipo Start Fund">
                        <img src="./public/assets/img/save-the-children.svg" alt="Logotipo Save The Children">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<div class="modalServices_menu">
    <div class="modal">
        <div class="body">
            <div class="closeBox">
                <div class="close-button" onclick="toogleMenuModal()">
                    <i class="material-icons">close</i>
                </div>
            </div>
            <div class="menu">
                <ul class="menu-ul">
                    <li>
                        <a href="#">PRONÓSTICO</a>
                    </li>
                    <li>
                        <a href="#">MONITOREO</a>
                    </li>
                    <li onclick="toogleSubMenuModal()">
                        <a href="#">RIESGO AGROCLIMATICO</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modalServices_sub-menu">
    <div class="modal">
        <div class="body">
            <div class="closeBox">
                <div class="close-button" onclick="toogleSubMenuModal()">
                    <i class="material-icons">close</i>
                </div>
            </div>
            <div class="menu">
                <ul class="menu-ul">
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Arroz (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-arroz">Mensual de Arroz</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Maiz (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-maiz">Mensual de Maiz</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Papa (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-papa">Mensual de Papa</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Cacao (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-cacao">Mensual de Cacao</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Café (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-cafe">Mensual de Café</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Pasto (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-pasto">Mensual de Pasto</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Quinua (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-quinua">Mensual de Quinua</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Palto (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-palto">Mensual de Palto</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Cebolla (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-cebolla">Mensual de Cebolla</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" onclick="toogleMenu(this)">Riesgo de Frijol (Feb) ▼ </a>
                        <ul class="menus">
                            <li><a href="?p=riesgo-frijol">Mensual de Frijol</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
-->