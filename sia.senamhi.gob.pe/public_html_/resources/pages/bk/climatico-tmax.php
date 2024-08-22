<a href="?p=climatico-pp" class="tab_menu ">Precipitación AGO</a>
<a href="?p=climatico-tmin" class="tab_menu ">TEMP Minima AGO</a>
<a href="?p=climatico-tmax" class="tab_menu active">TEMP Máxima AGO</a>


<div class="body"><br>
    <div class="header">
    <div class="descripcion"><p id="txtcopiar">El mapa provee información de Probabilidad de Ocurrencia de Temperatura Máxima a nivel nacional, en los próximos 3 meses. 
        <a href="https://www.senamhi.gob.pe/?&p=pronostico-climatico" target="_blank"><img src="public/assets/img/External.png"  width="15" height="15" /></a> |
        <button id="copyButton" style="background: none;  border: none; cursor: pointer;">   <img src="public/assets/img/copiar.png" alt="Copiar"  width="15" height="15" /></button> |
        <a href="http://www.senamhi.gob.pe/load/file/02262SENA-30.pdf" target="_blank"><img src="public/assets/img/pdf.png"  width="15" height="15" /></a>
    </p>
</div>
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
                <ul class="list__show fila1">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside"> <?php Component::view('table-escenario-climatico') ?></a>
                    </li>
                </ul>

            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                <span class="list__img"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <a href="#" class="nav__link">Departamentos  Afectados</a>
                    <span class="list__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </div>
               
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside">  <div id="filterDevProv" class="contentBox"></div></a>
                        
                    </li>
                </ul>
            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                <span class="list__img"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <a href="#" class="nav__link">Ampliar Rango de Consulta (mm)</b></a>
                    <span class="list__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                </div>
               
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside"> <?php  Component::view('filter-escenario-climatico') ?> </a>
                        
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
            if (menu.classList.contains('fila1')) { height=100;  } else {                 height=542;  }
            $('#graphic_dev').show();
        }
        //menu.style.height = `0px`;
        menu.style.height = `${height}px`;
        //menu.style.height = '748px';
        $('#graphic_dev').hide();

        
    })
});


document.getElementById("copyButton").addEventListener("click", function() {
  var text = document.getElementById("txtcopiar").innerText;

  // Crear un elemento de texto temporal
  var tempInput = document.createElement("textarea");
  tempInput.value = text;
  document.body.appendChild(tempInput);

  // Seleccionar y copiar el texto
  tempInput.select();
  document.execCommand("copy");
  document.body.removeChild(tempInput);

  // Cambiar el texto del botón después de copiar
 // this.innerHTML = "¡Copiado!";
});

    </script>

            <div id="graphic_dev" style="display:none;"></div>
