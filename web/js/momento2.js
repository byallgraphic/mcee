jQuery(document).ready(function() {
    var realizo_visita = $('#gcmomento2-realizo_visita');
    realizo_visita.prop('checked', true);
    $('.field-gcmomento2-justificacion_no_visita').hide();

    realizo_visita.click(function () {
        if($(this).prop('checked')){
            $('#content_visita').show();
            $('.field-gcmomento2-justificacion_no_visita').hide();
        }

        if(!$(this).prop('checked')){
            $('#content_visita').hide();
            $('.field-gcmomento2-justificacion_no_visita').show();
        }
    });

    var listPaso2 = $('#listPaso2');
    var counter = 1;
    var descripcion_visita = $('#gcmomento2-descripcion_visita');
    var estudiantes = $('#gcmomento2-estudiantes');
    var docentes = $('#gcmomento2-docentes');
    var directivos = $('#gcmomento2-directivos');
    var otro = $('#gcmomento2-otro');
    var dataPaso2 = {};
    dataPaso2.resultados = [];

    listPaso2.click(function () {
        var t = $('#datatables_w1').DataTable();
        if (
            descripcion_visita.val() !== "" &&
            estudiantes.val() != 0 &&
            docentes.val() != 0 &&
            directivos.val() != 0 &&
            otro.val() != 0
        ){
            t.row.add( [
                counter,
                descripcion_visita.val(),
                estudiantes.val(),
                docentes.val(),
                directivos.val(),
                otro.val()
            ] ).draw( false );

            var formData = new FormData();
            formData.append("id_semana", $('#id_semana').val());
            formData.append("descripcion_visita", descripcion_visita.val());
            formData.append("estudiantes", estudiantes.val());
            formData.append("docentes", docentes.val());
            formData.append("directivos", directivos.val());
            formData.append("otro", otro.val());

            var files = $('#dias_file').find(".file-dia");
            var files_length = files.length;
            for (var x = 0; x < files_length; x++) {
                formData.append("files[]", files[x].files[0]);
            }

            $.ajax({
                url: "index.php?r=gc-momento2%2Fadd-object",
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                data: formData,
                type: 'POST',
                success: function (res, status) {
                    if (status == 'success') {

                    }
                },
            });

            counter++;
            descripcion_visita.val("");
            estudiantes.val(0);
            docentes.val(0);
            directivos.val(0);
            otro.val(0);

            for (var y = 0; y < files_length; y++) {
                files[y].value = "";
            }
        }
    });
});

