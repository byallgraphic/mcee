<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}
/**********
Versión: 001
Fecha: Fecha en formato (09-03-2018)
Desarrollador: Viviana Rodas
Descripción: Formulario de formaciones
---------------------------------------
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// use yii\bootstrap\Collapse;
use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\PersonasFormaciones */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerJs(<<<JS
	
	$( document ).ready(function(){
	
		var intervalo = undefined;

		$( "#personasformaciones_id_personas_chosen .chosen-search > input" ).on( 'keyup', function(){ 

			var slOriginal = $( "#personasformaciones-id_personas" );

			var search = $( this );
			var value_search = search.val();

			if( value_search.length >= 3 )
			{
				clearTimeout( intervalo );
				intervalo = setTimeout( function(){
									search.attr({readOnly:true});
									
									clearTimeout( intervalo );
									
									$.get( "index?r=personas-formaciones/consultar-personas&search="+value_search, function( data ) {
										
										slOriginal.html('');
										
										for( var x in data ){
											slOriginal.append( "<option value='"+x+"'>"+data[x]+"</option>" );
										}
										
										slOriginal.trigger( 'chosen:updated' );
										search.val( value_search );
										search.css({readOnly:false});
										
									}, 'json' );
								}, 1000 );
			}
		});
	});
JS
);

?>

<div class="personas-formaciones-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php
		echo $form->field($model, 'id_personas')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => false, // Search input will be disabled while there are fewer than 5 items
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					],
			]);
	?>


    <?php // $form->field($model, 'id_personas')->dropDownList($personas, ['prompt'=>'Seleccione...']) ?>

    <?= $form->field($model, 'id_tipos_formaciones')->dropDownList($formaciones, ['prompt'=>'Seleccione...']) ?>

    <?= $form->field($model, 'horas_curso')->textInput(['maxlength' => true,'placeholder'=> 'Digite las horas del curso', 'id' =>'txtHoras']) ?>

    <?= $form->field($model, 'ano_curso')->textInput(['maxlength' => true,'placeholder'=> 'Digite el año', 'id' =>'txtAno']) ?>

    <?= $form->field($model, 'titulacion')->checkbox() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true,'placeholder'=> 'Digite el título', 'id' =>'txtTitulo']) ?>

    <?= $form->field($model, 'institucion')->textInput(['maxlength' => true,'placeholder'=> 'Digite la institución', 'id' =>'txtInst']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
