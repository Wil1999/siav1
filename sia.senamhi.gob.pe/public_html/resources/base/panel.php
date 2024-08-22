<?php $page = isset($_GET['p']) ? $_GET['p'] : 'inicio' ?>

<div class="containerVisor">
    <div class="panelControl <?= $page == 'inicio' ? 'collapsed' : '' ?>">
        <div class="panelControl_button <?= $page == 'inicio' ? 'collapsed' : '' ?>">
            <i class="material-icons">arrow_drop_down</i>
        </div>
        <?php Content::view('tab-info'); ?>
        <?php Content::view('tab-services'); ?>
        <div class="panelControl_details">
            <?php Content::view('page'); ?>
            <hr>
            <?php Content::view('footer'); ?>
        </div>
    </div>
    <!-- MAPA CONTAINER -->
    <div class="mapContainer">
        <div id="mapid"></div>
    </div>
    <!-- MAPA CONTAINER -->
</div>