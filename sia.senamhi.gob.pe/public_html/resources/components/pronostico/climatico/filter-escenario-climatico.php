<?php
$page = $_GET['p'];
$sobre_normal = ($page == 'climatico-tmin' || $page ==  'climatico-tmax') ? 'sobre-normal-red' : 'sobre-normal';
$bajo_normal = ($page == 'climatico-tmin' || $page ==  'climatico-tmax') ? 'bajo-normal-blue' : 'bajo-normal';

?>
<div class="contentBox">
    <div class="nivel">
        <div class="nivelBox">
            <div class="<?= $sobre_normal ?>">
                Sobre lo Normal
                <input class="chkZona" type="checkbox" id="chbox1" value="Sobre lo Normal" checked>
                <label for="chbox1"></label>
            </div>
            <div class="normal">
                Normal
                <input class="chkZona" type="checkbox" id="chbox2" value="Normal" checked>
                <label for="chbox2"></label>
            </div>
            <?php if ($page == 'climatico-pp') : ?>
                <div class="bajo-normal">
                    Bajo lo Normal
                    <input class="chkZona" type="checkbox" id="chbox3" value="Bajo lo Normal" checked>
                    <label for="chbox3"></label>
                </div>
            <?php endif; ?>

            <?php if ($page == 'climatico-tmin' || $page == 'climatico-tmax') : ?>
                <div class="<?= $bajo_normal ?>">
                    Bajo lo Normal
                    <input class="chkZona" type="checkbox" id="chbox3" value="Bajo lo Normal" checked>
                    <label for="chbox3"></label>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="nivel">
        <div class="nivelBox">
            <div class="significativo-estadisticamente">
                <div>No Significativo Estadisticamente</div>
                <input class="chkZona" type="checkbox" id="chbox4" value="No Significativo Estadisticamente" checked>
                <label for="chbox4"></label>
            </div>
            <?php if ($page == 'climatico-pp') : ?>
                <div class="periodo-seco">
                    Periodo Seco
                    <input class="chkZona" type="checkbox" id="chbox5" value="Periodo Seco" checked>
                    <label for="chbox5"></label>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="contentBox">
    <div class="selector">
        <div class="selectorText">Deseleccionar:</div>
        <input type="checkbox" id="chboxAll" value="-1" checked="">
        <label for="chboxAll"></label>
    </div>
</div>