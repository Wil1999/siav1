
    const pattern = /\b\w+-\w+-\w+-\d{8}\.pdf\b/g;
   
    var directory = "http://sia.senamhi.gob.pe/alertas/";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open('GET', directory, false); // false for synchronous request
    xmlHttp.send(null);
    var ret = xmlHttp.responseText;
    var fileList = ret.split('<td>');
    let pdfFiles = [...new Set(ret.match(pattern))];
    console.log(pdfFiles);
    //console.log(alerta_amarilla (pdfFiles));

    var existe_roja=0;
    var existe_amarilla=0;
    var existe_verde=0;
        
        for (i = 0; i < pdfFiles.length; i++) {
         //    console.log(pdfFiles[i]);
             const data = pdfFiles[i].split("-");
            if (data[1]=='ROJA' & data[0]=='HABIL' ) { 
                existe_roja++;
                console.log(pdfFiles[i]);
                pdf_roja=pdfFiles[i];
            }

            if (data[1]=='AMARILLA' & data[0]=='HABIL' ) { 
                existe_amarilla++;
                console.log(pdfFiles[i]);
                pdf_amarilla=pdfFiles[i];
            }

            if (data[1]=='VERDE' & data[0]=='HABIL' ) { 
                existe_verde++;
                console.log(pdfFiles[i]);
                pdf_verde=pdfFiles[i];
            }
        }
        
        if (existe_roja > 0) { 
            var alerta = document.getElementById("roja");  
            alerta.style.display = "block";  
            document.getElementById("link_roja").href = "?p=inicio&alerta=roja&pdf="+pdf_roja+"&msn=";
            //document.getElementById("visor1").setAttribute("src","alertas/"+ pdf);
        }
    
       
        if (existe_amarilla > 0) { 
            var alerta = document.getElementById("amarilla");  
            alerta.style.display = "block";  
               
            document.getElementById("link_amarilla").href = "?p=inicio&alerta=amarilla&pdf=" + pdf_amarilla+"&msn=";
            //document.getElementById("visor2").setAttribute("src","alertas/"+ pdf);

        }
 
        if (existe_verde> 0) { 
            var alerta = document.getElementById("verde");  
            alerta.style.display = "block";  
             document.getElementById("link_verde").href = "?p=inicio&alerta=verde&pdf=" + pdf_verde+"&msn=";
            //document.getElementById("visor3").setAttribute("src","alertas/"+ pdf);
        }
    
        
 

