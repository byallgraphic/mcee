<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento4 */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerCssFile("@web/css/momentos.css");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/momentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

//se captura el valor de la semana
// $id_bitacora= $_GET['id_bitacora'];   PENDIENTE QUE LLEGE EL PARAMETRO
$id_bitacora= 1;
$id_momento1= 4;

?>

<div class="gc-momento4-form">

			<?php $form = ActiveForm::begin(); ?>

				<fieldset>
						<h4>Informe mensual de acompañamiento</h4>
						<hr>
						<h4 class="text-justify">
							En la primera parte del documento haga un balance acumulativo del cumplimiento de los propósitos del acompañamiento trabajados hasta el momento, explicando el nivel de avance alcanzado en cada uno; justifique y argumente su respuesta. En la segunda parte escriba sus reflexiones acerca de las lecciones aprendidas y por último elabore una propuesta que le permita reformular, ajustar, cambiar y/o eliminar las actividades o acciones según su criterio y en función de los propósitos del acompañamiento. (<a href="../documentos/competencias_basicas/plantilla-informe-DT.docx">descargar plantilla para informe</a>). 
                            Asegúrese de que el archivo que va a subir haya sido guardado conservando la siguiente sintaxis: "Ciclo1PepitoPerezIENavarro.docx"
						</h4>
				
						<?= $form->field($model, 'id_bitacora')->hiddenInput(['value' => $id_bitacora])->label(false) ?>

						<?= $form->field($model, "estado")->hiddenInput(['value'=> 1])->label(false) ?>
						<br>
						<div class="row">
						  <div class="col-xs-6 col-md-4"><?php echo $form->field($model, 'url[]')->fileInput(['multiple'=>'multiple'])->label('Informe mensual de acompañamiento') ?></div>
						  <div class="col-xs-6 col-md-4"></div>
						  <div class="col-xs-6 col-md-4"></div>
						</div>
						
	

						<div class="form-group">
							<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
						</div>
				</fieldset>

			<?php ActiveForm::end(); ?>

</div>
