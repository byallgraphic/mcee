"use strict";

var next_step = false;

function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
        $('.form-wizard').stop().animate({scrollTop: scroll_to}, 0);
    }
}

function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if(direction == 'right') {
        new_value = now_value + ( 100 / number_of_steps );
    }
    else if(direction == 'left') {
        new_value = now_value - ( 100 / number_of_steps );
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

jQuery(document).ready(function() {
    $("#gcplaneacionpordia-id_dia-1").val(1);
    var btnAddDay = $('#btnAddDay');
    var saveMoment1 = $('#saveMoment1');
    var newVal = parseInt(btnAddDay.val());
    btnAddDay.click(function () {
        if (newVal <= 6){
            newVal = newVal+1;
            $( "#addDay-1" ).clone().attr('id', 'addDay-' + newVal).appendTo("#contentDays");
            btnAddDay.val((newVal));
            $("#addDay-"+ newVal +" #gcplaneacionpordia-id_dia-1").attr('id', 'gcplaneacionpordia-id_dia-' + newVal);
            $("#gcplaneacionpordia-id_dia-"+newVal).val(newVal);
            $("#addDay-"+ newVal +" #gcplaneacionpordia-descripcion_plan-1").attr('id', 'gcplaneacionpordia-descripcion_plan-' + newVal);
            $("#gcplaneacionpordia-descripcion_plan-"+newVal).val("");
        }
    });

    saveMoment1.click(function () {
        var parent_fieldset = $(this).parents('fieldset');
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
        var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');
        var checkProposito = $('#checkboxMomento1Semana1').find('input');
        var dayText = $('#contentDays').find('textarea');
        var arrayCheckPropositos = [];
        var arrayDays = {};
        var i = 0;

        checkProposito.each(function( index, element ) {
            if (element.checked){
                arrayCheckPropositos[i] = element.value;
                $('#propositos').append('<label id="'+element.value+'">'+element.parentElement.textContent+'</label><br>');
                i++;
            }
        });

        dayText.each(function( index, element ) {
            if (element.value !== ''){
                arrayDays[element.parentElement.children[1].value] = element.parentElement.children[1].value;
                arrayDays[element.parentElement.children[1].value] = element.value;
            }
        });

        var data = {
            id: $('#id').val(),
            arrayCheckPropositos: arrayCheckPropositos,
            arrayDay: arrayDays
        };


        // fields validation
        parent_fieldset.find('.required').each(function () {
            if ($(this).val() === "") {
                $(this).addClass('input-error');
                next_step = false;
            }
        });

        $.post("index.php?r=gc-momento1%2Fadd-object", data, function () {
        })
        .done(function () {
            next_step = true;
            parent_fieldset.fadeOut(400, function() {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                // progress bar
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class( $('.form-wizard'), 20 );
            });

            swal({
                text: 'Registro guardado',
                icon: 'success',
                button: 'Salir',
            });
        })
        .fail(function () {
            next_step = false;
        });

    });

    var listPaso2 = $('#listPaso2');
    var counter = 1;
    var nombre = $('#gcresultadosmomento1-nombre');
    var description = $('#gcresultadosmomento1-descripcion');
    var dataPaso2 = {};
    dataPaso2.resultados = [];

    listPaso2.click(function () {
        if (nombre.val() !== "" && description.val() !== ""){
            dataPaso2.resultados.push([nombre.val(), description.val()]);
            counter++;
            nombre.val("");
            $('#gcresultadosmomento1-descripcion').val("");

            var data = {
                resultados: dataPaso2
            };

            $.post( "index.php?r=gc-momento1%2Fadd-object2", data, function() {
            })
            .done(function () {
                $("#w2").load(location.href+" #w2>*","");
            });
        }
    });

    /*
        Form
    */
    $('.form-wizard fieldset:first').fadeIn('slow');

    $('.form-wizard .required').on('focus', function() {
        $(this).removeClass('input-error');
    });

    // next step
    $('.form-wizard .btn-next').on('click', function() {
        var parent_fieldset = $(this).parents('fieldset');
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
        var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');

        // fields validation
        parent_fieldset.find('.required').each(function() {
            if( $(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            }
            else {
                $(this).removeClass('input-error');
            }
        });
        // fields validation

        if( next_step ) {
            parent_fieldset.fadeOut(400, function() {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                // progress bar
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class( $('.form-wizard'), 20 );
            });
        }

    });

    // previous step
    $('.form-wizard .btn-previous').on('click', function() {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.form-wizard').find('.form-wizard-step.active');
        var progress_line = $(this).parents('.form-wizard').find('.form-wizard-progress-line');

        $(this).parents('fieldset').fadeOut(400, function() {
            // change icons
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class( $('.form-wizard'), 20 );
        });
    });

    // submit
    $('.form-wizard').on('submit', function(e) {

        // fields validation
        $(this).find('.required').each(function() {
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });
        // fields validation

    });


});





// image uploader scripts

var $dropzone = $('.image_picker'),
    $droptarget = $('.drop_target'),
    $dropinput = $('#inputFile'),
    $dropimg = $('.image_preview'),
    $remover = $('[data-action="remove_current_image"]');

$dropzone.on('dragover', function() {
    $droptarget.addClass('dropping');
    return false;
});

$dropzone.on('dragend dragleave', function() {
    $droptarget.removeClass('dropping');
    return false;
});

$dropzone.on('drop', function(e) {
    $droptarget.removeClass('dropping');
    $droptarget.addClass('dropped');
    $remover.removeClass('disabled');
    e.preventDefault();

    var file = e.originalEvent.dataTransfer.files[0],
        reader = new FileReader();

    reader.onload = function(event) {
        $dropimg.css('background-image', 'url(' + event.target.result + ')');
    };

    console.log(file);
    reader.readAsDataURL(file);

    return false;
});

$dropinput.change(function(e) {
    $droptarget.addClass('dropped');
    $remover.removeClass('disabled');
    $('.image_title input').val('');

    var file = $dropinput.get(0).files[0],
        reader = new FileReader();

    reader.onload = function(event) {
        $dropimg.css('background-image', 'url(' + event.target.result + ')');
    }

    reader.readAsDataURL(file);
});

$remover.on('click', function() {
    $dropimg.css('background-image', '');
    $droptarget.removeClass('dropped');
    $remover.addClass('disabled');
    $('.image_title input').val('');
});

$('.image_title input').blur(function() {
    if ($(this).val() != '') {
        $droptarget.removeClass('dropped');
    }
});
// image uploader scripts