<a href="?p=riesgo-arroz" class="tab_menu2 ">Arroz</a>
<a href="?p=riesgo-cacao" class="tab_menu2 ">Cacao</a>
<a href="?p=riesgo-cafe" class="tab_menu2 ">Café</a>
<a href="?p=riesgo-frijol" class="tab_menu2 ">Frijol</a>
<a href="?p=riesgo-maiz" class="tab_menu2 ">Maiz</a>
<a href="?p=riesgo-palto" class="tab_menu2 ">Palto</a>
<a href="?p=riesgo-papa" class="tab_menu2 ">Papa</a>
<a href="?p=riesgo-pasto" class="tab_menu2 ">Pasto</a>
<a href="?p=riesgo-quinua" class="tab_menu2 ">Quinua</a>


<div class="body"><br>
    <div class="header">
    <div class="descripcion"><p>El mapa provee información pronosticada del riesgo agroclimático para el cultivo de <b>CEBOLLA</b> que podría presentarse en los próximos meses. La información presentada en el mapa proviene de la red de observación meteorológica del SENAMHI.</p></div>
    </div>
</div>

<br>
<nav class="nav">
        <ul class="list">

            <li class="list__item list__item--click fila1">
                <div class="list__button list__button--click">
                <span class="list__img"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <a href="#" class="nav__link">Información Actual</a>
                    <span class="list__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </div>
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside"> <?php Component::view('table-nivel') ?></a>
                    </li>
                </ul>

            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                <span class="list__img"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <a href="#" class="nav__link">Departamentos por Niveles de Riesgo Afectados</a>
                    <span class="list__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </div>
               
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside"> <br> <div id="filterDevProv" class="contentBox"></div></a>
                        
                    </li>
                </ul>
            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                <span class="list__img"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <a href="#" class="nav__link">Ampliar Rango de Consulta  (mm)</b></a>
                    <span class="list__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </div>
               
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside"> <?php  Component::view('filter-nivel') ?> </a>
                        
                    </li>
                </ul>
            </li>


        </ul>



   <!-- esto tiene que ir de todas maneras--> 
        <div class="header">  <?php // Component::view('filter-rango-evapotranspiracion') ?></div>
   <!---->
</nav>


   <!-- <div id="filterDevProv2" class="contentBox2"></div> -->
    <script>
        let listElements = document.querySelectorAll('.list__button--click');

        listElements.forEach(listElement => {
        listElement.addEventListener('click', ()=>{
        
        listElement.classList.toggle('arrow');

        let height = 0;
        let menu = listElement.nextElementSibling;
        
        $('#graphic_dev').hide();
        if(menu.clientHeight == "0"){
            height=menu.scrollHeight;
            height=542
            $('#graphic_dev').show();
        }
        //menu.style.height = `0px`;
        menu.style.height = `${height}px`;
        //menu.style.height = '748px';
        $('#graphic_dev').hide();

        
    })
});
    </script>

            <div id="graphic_dev" style="display:none;"></div>
