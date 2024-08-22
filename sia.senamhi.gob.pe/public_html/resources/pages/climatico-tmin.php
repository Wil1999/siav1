<div class="body">
    <div class="header">
        <div class="title">Probabilidad de Ocurrencia de Temperatura Mínima Trimestral</div>
        <div class="description">El mapa provee información de Probabilidad de Ocurrencia de Temperatura Mínima a nivel nacional, en los próximos 3 meses.</div>
        <div class="file"></div>
    </div>
    <hr>
    <div class="content">

        <?php Component::view('historial-escenario-climatico'); ?>

        <?php Component::view('table-escenario-climatico') ?>
        <hr>
        <div id="filterDevProv" class="contentBox"></div>
        <hr>
        <?php Component::view('filter-escenario-climatico') ?>
    </div>
</div>