<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/** CONTROLLER **/
//require_once 'src/Template/TemplateController.php';
require_once 'src/Menu/MenuController.php';
require_once 'src/Historial/HistorialController.php';

/** MODELS **/
require_once 'src/Menu/Menu.php';
require_once 'src/Historial/Historial.php';

/** HELPERS **/
require_once 'helpers/init.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=UTF8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

    <title>SISTEMA DE INFORMACIÓN AGROMETEOROLÓGICA | SIAH</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
 
    <!-- Fonts -->
    <link href="https://static.electricitymap.org/public_web/css/EuclidTriangleFont.css" rel="stylesheet">
    <link href="https://static.electricitymap.org/public_web/css/OpenSansFont.css" rel="stylesheet">
    <link href="https://static.electricitymap.org/public_web/css/MaterialIcons.css" rel="stylesheet">

    <!-- Leaflet Library -->
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet/1.5.1/leaflet.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MousePosition/L.Control.MousePosition.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MagnifyingGlass/leaflet.magnifyingglass.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-GroupedLayerControl/leaflet.groupedlayercontrol.min.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ZoomHome/leaflet.zoomhome.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-BoxZoom/leaflet-control-boxzoom.css" rel="stylesheet" />
    <link href="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-Fullscreen/Leaflet.fullscreen.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="public/assets/dist/css/main.css">
    <?php Content::view('css-template') ?>

    <link rel="stylesheet" href="resources/css/style_menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="resources/css/custom.css">
    <link rel="stylesheet" href="resources/css/menu_desplegable.css">
    
</head>

<body>

<!-- Header -->
<div style="position: absolute; top: 0px; left: 0px;"><?php Content::view('header') ?> </div>
<!-- End Header -->

<!-- Enrutamiento -->
    <?php
    $pg = isset($_GET['p']) ? $_GET['p'] : 'inicio' ;
    ?>
<!-- End Enrutamiento -->

<!-- Navigation -->
<div class="navigation active">
            <div class="toggle" style="cursor: pointer;"></div> 
            <ul>
                <li>
                    <a href="?p=inicio">
                        <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        <span class="title">Monitoreo </span>
                    </a>

                </li>
                <li>
                    <a href="?p=evapotranspiracion-1ra">
                        <span class="icon"></span>
                        <span class="title">Evapotranspiración </span>
                    </a>

                </li>
                <li>
                    <a href="?p=indice-humedad-1ra">
                        <span class="icon"></span>
                        <span class="title">Índice de Humedad </span>
                    </a>

                </li>
                <li>
                    <a href="">
                        <span class="icon"><i class="fa fa-cloud" aria-hidden="true"></i></span>
                        <span class="title">Pronóstico </span>
                    </a>
                </li>
                <li>
                    <a href="?p=climatico-pp">
                        <span class="icon"></span>
                        <span class="title">Climático </span>
                    </a>

                </li>
                <li>
                    <a href="?p=riesgo-arroz">
                        <span class="icon"></span>
                        <span class="title">Riesgo por Cultivo </span>
                    </a>

                </li>
                <li>
                    <a href="?msn=estudios">
                        <span class="icon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        <span class="title">Estudios </span>
                    </a>
                </li>
                <li>
                    <a href="?p=inicio">
                        <span class="icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <span class="title">Recursos </span>
                    </a>
                </li>
                <li>
                    <a href="?msn=acercade"  >
                        <span class="icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                        <span class="title">Acerca de  </span>
                    </a>
                </li>
            </ul>  
</div>
<!-- End Navigation -->


<!-- Navigation 2 @media Tablet-->
<div class="navbar" id="topnav">
  <a href="?p=inicio">
    <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
    <span class="title">Inicio </span>
  </a>
  <div class="dropdown">
    <a href="#" class="dropbtn">
                        <span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        <span class="title">Monitoreo </span>
                    </a>
    <div class="dropdown-content">
        <a href="?p=evapotranspiracion-1ra">
            <span class="subtitle">Evapotranspiración </span>
        </a>
        <a href="?p=indice-humedad-1ra">
            <span class="subtitle">Índice de Humedad </span>
        </a>
    </div>
  </div> 
  <div class="dropdown">
    <a href="#" class="dropbtn">
        <span class="icon"><i class="fa fa-cloud" aria-hidden="true"></i></span>
        <span class="title">Pronóstico </span>
    </a>
    <div class="dropdown-content">
        <a href="?p=climatico-pp">
            <span class="subtitle">Climático </span>
        </a>
        <a href="?p=riesgo-arroz">
            <span class="subtitle">Riesgo por Cultivo </span>
        </a>
    </div>
  </div>
    <a href="?msn=estudios">
        <span class="icon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
        <span class="title">Estudios </span>
    </a> 
    <a href="?msn=acercade"  >
        <span class="icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
        <span class="title">Acerca de  </span>
    </a>
    <a href="#" style="font-size:15px;" class="icon-navbar" onclick="myFunctionNav()">&#9776;</a>
</div>
<script>
 function myFunctionNav() {
  var x = document.getElementById("topnav");
  if (x.className === "navbar") {
    x.className += " responsive";
  } else {
    x.className = "navbar";
  }
} 
</script>
<!-- End Navigation 2 @media Tablet-->

<!-- Pagina Inicio -->
<?php  if ($pg=='inicio' && !isset($_GET['alerta']) && !isset($_GET['msn'])) {?> 
<div class="dataini active" id="inicio">
    <div class="toggle3 active"> </div> 
    <!-- <div><p class="tituloprincipal"> <b>SISTEMA DE INFORMACION AGROMETEOROLOGICA</b></p></div> -->
    <div class="container-box">
        <div class="box1 bx">
            <img width="380px" height="160px" src="admin/assets/img/ojo.jpg"></img>
        <h1 class="titulo"><a class="hiper" href="?p=evapotranspiracion-1ra" style="font-size:25px">Monitoreo</a></h1>
        <p class="parrafo"> Este módulo provee información actualizada del seguimiento de los principales índices agrometeorológicos. 
        </p>

        <!-- ----- -->
        <div class="box-popup">
            <a class="button-popup" href="#popup1" style="font-size:13px">Ver más...</a>
        </div>
        <!-- ----- -->

        </div>
        <div class="box2 bx"> <img width="380px" height="160px"  src="admin/assets/img/pronostico.jpg"></img>
        <h1  class="titulo"> <a class="hiper" href="?p=climatico-pp" style="font-size:25px">Pronóstico</a></h1>
        <p class="parrafo"> Este módulo provee información de probabilidad de impactos ocurrencia de lluvias, pronóstico de riesgo agroclimático de los principales cultivos a nivel nacional.
        </p>
        <!-- ----- -->
        <div class="box-popup">
            <a class="button-popup" href="#popup2" style="font-size:13px">Ver más...</a>
        </div>
        <!-- ----- -->

        </div>
        <div class="box3 bx"> <img width="380px" height="160px"  src="admin/assets/img/reporte.jpg"></img>
        <h1 class="titulo"> <a class="hiper" href="?msn=estudios" style="font-size:25px">Información o Publicaciones</a></h1>
        <p class="parrafo"> Este módulo permite acceder a publicaciones, material de difusión, noticias, entre otros. 
        </p>

        <!-- ----- -->
        <div class="box-popup">
            <a class="button-popup" href="#popup3" style="font-size:13px">Ver más...</a>
        </div>
        <!-- ----- -->

        </div>
    </div>
    
    <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Monitoreo</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                Este módulo provee información actualizada del seguimiento de los principales índices agrometeorológicos.
                </div>
            </div>
        </div>

        <div id="popup2" class="overlay">
            <div class="popup">
                <h2>Pronóstico</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                Este módulo provee información de probabilidad de impactos ocurrencia de lluvias, pronóstico de riesgo agroclimático de los principales cultivos a nivel nacional.
                </div>
            </div>
        </div>
        <div id="popup3" class="overlay">
            <div class="popup">
                <h2>Información o Publicaciones</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                Este módulo permite acceder a publicaciones, material de difusión, noticias, entre otros. 
                </div>
            </div>
        </div>
<!-- End Pagina Inicio -->


<?php } elseif ($pg<>'inicio' && !isset($_GET['alerta']) && !isset($_GET['msn']))  { ?>       
<div class="data active">
    <div class="toggle2">
        <span class="icon-toggle">
            <svg class="w-6 h-6" style="color: white;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
        </span>
        <span 
        class="<?php 
        if ($pg=='climatico-pp' || 
            $pg=='climatico-tmin'  || 
            $pg=='climatico-tmax' || 
            $pg=='riesgo-arroz' || 
            $pg=='riesgo-cacao' || 
            $pg=='riesgo-cafe' || 
            $pg=='riesgo-cebolla' || 
            $pg=='riesgo-frijol' || 
            $pg=='riesgo-maiz' || 
            $pg=='riesgo-palto' || 
            $pg=='riesgo-papa' || 
            $pg=='riesgo-pasto' || 
            $pg=='riesgo-quinua'  )   echo "titulo1"; else echo "titulo" ?>" style="cursor: pointer;">
        </span>
    </div> 

<?php } elseif ($_GET['msn']=='acercade')  { ?>
    
        <div class="dataini2 active" id="inicio">
    <div class="toggle3 active"></div> 
    <div><p class="tituloprincipal"> <b>SISTEMA DE INFORMACION AGROMETEOROLOGICA</b></p></div>
   
    
                <div class="containerGroup">
                    <p class="question">
                    Esta plataforma web es un esfuerzo conjunto entre el Servicio Nacional de Meteorología e Hidrología del Perú (SENAMHI) y la Organización No Gubernamental Save The Children Perú para poner a disposición de los usuarios la información agrometeorológica confiable y oportuna para la gestión de riesgos asociados al  clima en el sector agropecuario, lo que repercutirá en mejoramiento de la competitividad de la agricultura nacional, la seguridad alimentaria, la economía y los ingresos económicos de la población rural.  
                    </p><br>
                    <br>                    
                    <br>                    
                        <h3>Un proyecto realizado por:</h3>
                        <div class="menuDesktop_center">
                            <a href="http://senamhi.gob.pe/" target="_blank">
                            <img src="https://www.senamhi.gob.pe/public/images/logo-senamhi.svg" alt="Logotipo SENAMHI">     </a> 
                            <a href="#">  <img src="https://idesep.senamhi.gob.pe/balance-hidrico/assets/img/sidebar/minam.svg" alt="Logotipo Minam">
                                
                            </a> 
                        </div>
                    
                        <h3>Con el financiamiento de:</h3>
                        <div class="menuDesktop_center">
                            
                            <a href="#">
                                <img src="./public/assets/img/save-the-children.svg" alt="Logotipo Save The Children">
                            </a>
                            <a href="#">    
                                <img src="./public/assets/img/start-fund.svg" alt="Logotipo Start Fund">
                            </a> 

                    </div>

                </div>
    
    </div>
    
    <?php //} ?>

    <?php  } elseif ($pg=='inicio' && isset($_GET['alerta'])) { 
    
      function isValidPdfFile($fileName) {
        $pattern = "/^[\w-]+-\d{8}\.pdf$/";
        return preg_match($pattern, $fileName) === 1;
      }
      
      $fileName = $_GET['pdf'];
      if (isValidPdfFile($fileName)) {
        $url_pdf=$fileName;
      }
      else
      {
        $url_pdf="";
      }
        ?> 

       <div class="dataini active" id="inicio">
       <div class="visor"><embed id="visor"  src="<?PHP echo "alertas/".$url_pdf; ?>" type="application/pdf" /></div>
        
    </div> 
     
  
    
    <?php } elseif ($_GET['msn']=='estudios')  { ?>
    
    <div class="dataini2 active" id="inicio">
    <div class="toggle3 active"> </div>         
            
            <?PHP 
            function postApi($url, $data) {

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;

            }
            
            $url = "https://www.senamhi.gob.pe/include/_estudios-e-investigaciones.php";
            $data = array();
            $response = postApi($url, $data);
            $data = json_decode($response, true);
            //var_dump(json_encode($data));
            
            $filtered_data = array();
            foreach($data['data'] as $d) {
                
              if($d['tag'] == 'Agrometeorologia') { 
                $d['link'] = str_replace('..', 'https://www.senamhi.gob.pe', $d['link']);
                $filtered_data[] = $d;
              }
            }
            
             ?>

        <table id="data_table1"  >
      <thead>
        <tr>
          <th style="width: 200px;" > Fecha    </th>
          <th>Tipo</th>
          <th>Link</th>
        </tr>
      </thead>
    </table>

    </div>


    
<?php } ?>


    <?php
      Content::view('page'); 
      Content::view('modal-menu') ;
    
    ?>
</div>



    <main>
        <!-- HEADER -->

        <div class="containerVisor">
    
            <!-- MAPA CONTAINER -->
            <div class="mapContainer">
                <div id="mapid"></div>
            </div>
            <!-- MAPA CONTAINER -->
        </div>

    </main>



   



</body>
<script>
    const navigation = document.querySelector('.navigation');
    document.querySelector('.toggle').onclick = function(){
        this.classList.toggle('active');
        navigation.classList.toggle('active')
    }
    const data = document.querySelector('.data');
    document.querySelector('.toggle2').onclick = function(){
        this.classList.toggle('active');
        data.classList.toggle('active')
    }

</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 


    
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
  $( function() {
    $( ".navigation" ).draggable();
  } );
  $( function() {
    $( ".data" ).draggable();
  } );
  </script>

<script>
$(document).ready(function() {
      $('#data_table1').DataTable({
        data: <?php echo json_encode($filtered_data); ?>,
        columns: [
          { data: "fecha" },
          { data: "tipo" },
          { data: "link" },
        ]
      });
    });
    </script>

    
<!--<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/jquery/jquery-3.2.1.min.js"></script>-->
<!-- Leaflet Library -->
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet/1.5.1/leaflet.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MousePosition/L.Control.MousePosition.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-MagnifyingGlass/leaflet.magnifyingglass.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ControlCustom/Leaflet.Control.Custom.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-GroupedLayerControl/leaflet.groupedlayercontrol.min.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-ZoomHome/leaflet.zoomhome.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-BoxZoom/leaflet-control-boxzoom.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-omnivore/leaflet-omnivore.min.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-Fullscreen/Leaflet.fullscreen.js"></script>
<script src="https://www.senamhi.gob.pe/mapas/mapa-climatico-v2/public/lib/leaflet-adds/leaflet-wms/leaflet.wms.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!--
<script src="https://rowanwins.github.io/leaflet-easyPrint/dist/bundle.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://unpkg.com/leaflet-simple-map-screenshoter"></script>
-->
<script src="https://unpkg.com/file-saver/dist/FileSaver.js"></script>
<script src="public/assets/dist/js/maco-screenshoter.js"></script>


<script src="public/assets/dist/js/main.js"></script>

<?php Content::view('js-template') ?>

<script src="resources/js/custom.js"></script>
<script src="resources/js/alertas.js"></script>
