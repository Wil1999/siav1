var tableI;
var tabla;
var id_t;
var nom;

listar();

function listar() {
    let arrayMod = [];

    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: "http://sia.senamhi.gob.pe:8080/sia/producto",
        dataType: 'json',
        success: function (response) {
            let a = 0;
            for (let t in response) {
                if (response[t].esquema === "db11") {
                    rowId = {};
                    rowId["fila"] = a + 1;
                    const concatenar = Object.assign(response[t], rowId)
                    arrayMod.push(concatenar)
                    a++;
                }
            }
            llenarTablaI(arrayMod);
        }
    });
}




function llenarTablaI(data, index = null, value = null) {

    tableI = $('#tblboletinesAgroCultivo').DataTable({
        "bAutoWidth": false,
        "bFilter":false,
        "paging": false,
        "ordering": false,
        "info": false,
        "destroy": true,
        "data": data,
        "columns": [
            { "data": "fila" },
            { "data": "nombre" },
            { "data": "enlace" },
            {
                "data": "id", render: function (data, type, row) {
                    return '<center> <button class="btn btn-success" type="button" value="' + row.fila + '" onclick="cargaDatos(this.value)">' +
                        '<i class="bi bi-check-circle"></i></button></center>';
                }
            }
        ],
        "rowId": 'fila'
    });

}


function cargaDatos(fila) {

    let j = fila - 1;
    nom = tableI.row(j).data().nombre;
    id_t = tableI.row(j).data().id;
    tabla = tableI.row(j).data().tabla;

    document.getElementById("tituloAgro").innerHTML = nom;

    $("#modal1").modal("show");

}

function guardar() {

    let lk = $("#val_link").val();
    let obj = {
        enlace: lk,
        esquema: "db11",
        id: id_t,
        nombre: nom,
        tabla: tabla
    }

    $.ajax({
        type: "POST",
        contentType: "application/json",
        url: "http://sia.senamhi.gob.pe:8080/sia/producto/ficha",
        data: JSON.stringify(obj, null, 4),
        dataType: 'json',
        success: function (response) {
            
            listar();
            

        },
        error: function(){
            listar();
        }
    });
    $("#val_link").val("");
    $("#modal1").modal("hide");
}