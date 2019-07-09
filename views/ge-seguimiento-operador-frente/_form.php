<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrente */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerCssFile('@web/css/GeSeguimientos.css');

if( !$sede ){
    $this->registerJs( "$( cambiarSede ).click()" );
    return;
}

?>

<div class="ge-seguimiento-operador-frente-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'form_frente']]); ?>

    <?php /*$form->field($model, 'id_tipo_seguimiento')->textInput()*/ ?>
    <input name="idTipoSeguimiento" type="hidden" value="<?= $idTipoSeguimiento ?>">

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	
	<h3 style='background-color:#ccc;padding:5px;'><?= "DATOS GENERALES"?></h3>

    <?= $form->field($model, 'id_persona_diligencia')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])   ?>

    <?= $form->field($model, 'id_gestor_a_evaluar')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])   ?>

    <?= $form->field($model, 'mes_reporte')->dropDownList( $mesReporte, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($model, 'fecha_corte')->widget( 
			DatePicker::className(), [
				
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
		]) ?>
		
	<h3 style='background-color:#ccc;padding:5px;'><?= "Plan de trabajo equipo gestor"?></h3>
		
    <?= $form->field($model, 'cumple_cronograma')->radioList( $sino ) ?>

    <?= $form->field($model, 'descripcion_cronograma')->textarea() ?>

    <?= $form->field($model, 'compromisos_establecidos')->dropDownList( $seleccion, [ 'prompt' => 'Seleccione...' ]) ?>

    <?= $form->field($model, 'cuantas_reuniones')->textInput() ?>

    <?= $form->field($model, 'aportes_reuniones')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'logros')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'dificultades')->textarea(['maxlength' => true]) ?>

    <div class="evidencia_actividades">
        <?= $form->field($model, 'documentFile[]')->fileInput(['multiple' => true, 'id' => "file-upload-1"]) ?>
        <?php if (isset($model->id)){?>
                <div id="nameElement">
                    <?php $files = \app\models\GeSeguimientoFile::find()->where(['id_seguimiento_frente' => $model->id ])->asArray()->all(); ?>
                    <ul>
                        <?php foreach($files AS $file){ ?>
                            <li id="line_file_<?= $file['id'] ?>" class="line-file-name"><a class="name-file" href="..\documentos\seguimientoOperador\<?= $file['file'] ?>" download><?= $file['file'] ?></a><div onclick='deleteFile("<?= $file['id'] ?>")' class='delete-line'>x</div></li>
                        <?php } ?>
                    </ul>
                </div>
        <?php }else{ ?>
            <div class="evidencia_actividades">
                <div id="nameElement">
                    <ul></ul>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php /* $form->field($model, 'estado')->textInput() */ ?>

    <div class="form-group">
	
		<?php if ( !$guardado ) : ?>

            <?= Html::button('Guardar', ['class' => 'btn btn-success',  'id' => 'save_form', 'value' => 0]) ?>

		<?php endif ?>
		
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs( "$('#modalContent .main-footer').hide()" );
?>



<script>
    $('#file-upload-1').change(function(e){
        var files = $(this).prop("files");
        var files_length = files.length;
        for (var x = 0; x < files_length; x++) {
            $(this).parent().parent().find('#nameElement').find('ul').append('<li class="line-file-name"><span class="name-file">'+files[x].name+'</span><div onclick="$(this).parent().remove()" class=\'delete-line\'>x</div>' + '</li>')
        }
    });


    function deleteFile(id) {
        $.ajax({
            url: "index.php?r=ge-seguimiento-operador%2Fdfile&id="+id,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            type: 'GET',
            success: function (res, status) {
                if (status){
                    $('#line_file_'+id).remove();
                }
            },
        });
    }

    $('#save_form').click(function(e) {
        e.preventDefault();
        var validacion = 1;

        $('[id*=\'file-upload-\']').each(function () {
            console.log($(this));
            if ($(this).parent().parent().find('li').length === 0) {
                $(this).parent().addClass('has-error');
                $(this).parent().find('.help-block').html('Este campo es requerido.');
                validacion = 0;
            }
        });


        if (validacion === 0) {
            return false;
        }else {
            $( "#form_frente" ).submit();
        }
    });
</script>
