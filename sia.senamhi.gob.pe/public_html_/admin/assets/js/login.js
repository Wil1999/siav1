
function ingreso() {

    let usuario = $("#nombreUsuario").val();
    let pasw = $("#password").val();

    let obj = {
        nombreUsuario: usuario,
        password: pasw
    }

    $.ajax({
        type: "POST",
        contentType: "application/json",
        url: "http://sia.senamhi.gob.pe:8080/sia/login",
        data: JSON.stringify(obj, null, 4),
        dataType: 'json',
        success: function (response) {

            window.location.href = './pronostico.php'

        },
        error: function () {
            console.log("asodjaskdjasd")
        }
    });



}