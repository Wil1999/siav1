<?php
$menu = (new MenuController)->list();
?>
<div class="panelControl_tab-services">
    <!--<div class="header">Servicios</div>-->
    <div class="body">
        <div class="bodyContainer">
            <div class="menu">
                <ul class="menu-ul" style="text-align: center;">
                    <?php foreach ($menu['temas'] as $key => $tema) :  ?>
                        <li>
                            <a href="#" onclick="toogleMenu(this)"><?= $tema->temaNomCorto ?><font size="1"> ▼ </font></a>

                            <ul class="sub-menu-ul">
                                <?php foreach ($menu['grupos'] as $key => $grupo) :  ?>
                                    <?php if ($tema->codtema ==  $grupo->codtema) : ?>
                                        <li>
                                            <a href="#" onclick="toogleSubMenu(this)"><?= $grupo->grupoNomCorto ?><font size="1">▼</font></a>
                                            <ul class="sub-menu">
                                                <?php foreach ($menu['objetos'] as $key => $objeto) :  ?>
                                                    <?php if ($grupo->codtema ==  $objeto->codtema && $grupo->codgrupo ==  $objeto->codgrupo) : ?>
                                                        <li><a href="<?= $objeto->linkWeb ?>"><?= $objeto->objetoNombreCorto ?></a></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>