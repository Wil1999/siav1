$('.temaMenuSelect').on('click', function () {

    var depName = $(this).attr('id');
    var correProvName = $('.tema_' + depName);


    $('.temaMenuSelect').children('i').html('keyboard_arrow_down')
    $('.temaMenuSelect').parent('li').removeClass('active')

    $(this).children().last().html('chevron_right')
    $(this).parent().addClass('active')

    $('.grupoMenuBox').show()
    $('.objetoMenuBox').hide()

    $('.grupoMenuTotal').hide()
    correProvName.show();

    if (correProvName.length <= 0) {
        $('.grupoMenuBox').hide()
    }
});


$('.grupoMenuTotal').on('click', function () {

    var provDepName = $(this).attr('id');

    var nombreDepProv = provDepName.split('_');

    var nombreProvincia = nombreDepProv[1];

    let distName = $('.grupo_' + nombreProvincia);


    $('.grupoMenuTotal').children().children('i').html('keyboard_arrow_down')
    //$('.grupoMenuTotal').removeClass('active')

    $(this).children().children('i').html('chevron_right')
    //$(this).addClass('active')

    $('.objetoMenuBox').show();

    $('.objetoMenuTotal').hide();
    distName.show();

    if (distName.length <= 0) {
        $('.objetoMenuBox').hide()
    }

});