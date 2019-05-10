<?php
/********************
Modificaciones:
Fecha: 11-04-2019
Persona encargada: Viviana Rodas
Cambios realizados: Se agrega bootstrap al formulario
----------------------------------------
**********/

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/contenedor.js' ) );
$this->registerJs( file_get_contents( '../web/js/sensibilizacion.js' ) );


?>

<script>

//Click del boton agregar equipo campo y cargar contenido del formulario agregar en el modal
$("#modalEquipo").click(function()
{
	$("#modalCampo").modal('show')
	.find("#modalContenido")
	.load($(this).attr('value'));
});

</script>


<div class="isa-iniciacion-sencibilizacion-artistica-form">

    <?php $form = ActiveForm::begin(); ?>
	
	  <label>
        <input type="hidden" id="id" value="<?= isset($model->id) ? $model->id : ''?>">
    </label>
<div class="row">
	<div class="col-md-8">
		<?= $form->field($model, 'id_institucion')->dropDownList($institucion) ?>
		
	</div>
	<div class="col-md-4"></div>
</div>
	
	<div class="row">
	  <div class="col-md-8"><?= $form->field($model, 'id_sede')->dropDownList($sede) ?></div>
	  <div class="col-md-4"></div>
	</div>
    
	<div class="row">
		<div class="col-md-6"><?= $form->field($model, 'caracterizacion_si_no')->dropDownList($arraySiNo ) ?></div>
		<div class="col-md-6"></div>
	</div>
    
	<div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_nombre')->textInput() ?></div>
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_fecha')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
            ],
    ]);  ?></div>
	</div>
    

    <div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_justificacion')->textInput() ?></div>
	  <div class="col-md-6"><?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> </div>
	</div>
    
	

    <div class="panel panel panel-primary" >
        <div class="panel-heading" style="margin-bottom: 15px;">Fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.</div>
        <?= $this->context->actionViewFases($model, $form);   ?>
    </div>
  

    <div class="form-group">
        <?php  Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		
		
		<?php
            if (Yii::$app->request->get('id'))
			{
				  Html::submitButton('Guardar actualizar', ['class' => 'btn btn-success']);
            }
			else
			{
				 Html::button('Guardar', ['class' => 'btn btn-success',  'id' => 'save_form', 'value' => 0]);
            }
				echo Html::submitButton('Guardar', ['class' => 'btn btn-success']);
		 ?>
		<?php  Html::button('Guardar save form', ['class' => 'btn btn-success', 'id' => 'save_form', 'value' => 0]) ?>
		
		<?php Html::button('Guardar save form', ['class' => 'btn btn-success', 'id' => 'save_form', 'value' => 1]) ?>
    </div>

    <?php ActiveForm::end(); ?>

	
	<?=$this->registerCss("
					.nav-tabs > li 
					{
						width: 50%;
						
					}
					a[href='#w3-tab0']
					{
						height: 82px;
					}
					"); ?>
</div>
