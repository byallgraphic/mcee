
$( document ).ready(function()
{


    $('#pazCulturaSave').click(function () {
        var validacion = 1;
        var descripcion = $('#pazcultura-0-descripcion');
        var perfil = $('#pazcultura-0-tipo_perfil');
        var files = $('#pazcultura-0-file');

        if (!descripcion.val()) {
            descripcion.parent().addClass('has-error');
            descripcion.parent().find('.help-block').html('El campo descripcion debe estar lleno');
            validacion = 0;
        } else
            descripcion.parent().removeClass('has-error');

        if (!perfil.val()) {
            perfil.parent().addClass('has-error');
            perfil.parent().find('.help-block').html('debe seleccionar un perfil');
            validacion = 0;
        } else
            perfil.parent().removeClass('has-error');

        if (files.prop("files").length === 0 ) {
            files.parent().addClass('has-error');
            files.parent().find('.help-block').html('debe seleccionar un archivo');
            validacion = 0;
        } else
            perfil.parent().removeClass('has-error');

        if (validacion === 1){
            $(this).submit();
        }

        /*var datos = {
          count: 1
        };
        $.ajax({
            url: "index.php?r=paz-cultural%2Fvalidate-model",
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: datos,
            type: 'POST',
            success: function (res, status) {
                if (status == 'success') {
                    console.log(res)
                }
            }
        });*/
    });
});