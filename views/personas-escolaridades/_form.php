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
Fecha: Fecha en formato (12-03-2018)
Desarrollador: Viviana Rodas
Descripción: Formulario de Escolaridades
---------------------------------------
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\PersonasEscolaridades */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerJs(<<<JS
	
	$( document ).ready(function(){
		
		$( "#personasescolaridades-id_personas" ).on( 'chosen:showing_dropdown', function(){ 
			$( "#personasescolaridades_id_personas_chosen" ).removeClass( 'chosen-container-single-nosearch' );
			$( "#personasescolaridades_id_personas_chosen .chosen-search > input" ).attr({readOnly:false});
		})
	
		var intervalo = undefined;

		$( "#personasescolaridades_id_personas_chosen .chosen-search > input" ).on( 'keyup', function(){ 

			var slOriginal = $( "#personasescolaridades-id_personas" );

			var search = $( this );
			var value_search = search.val();

			if( value_search.length >= 3 )
			{
				clearTimeout( intervalo );
				intervalo = setTimeout( function(){
									search.attr({readOnly:true});
									
									clearTimeout( intervalo );
									
									$.get( "index?r=personas-escolaridades/consultar-personas&search="+value_search, function( data ) {
										
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

<div class="personas-escolaridades-form">

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

    <?= $form->field($model, 'id_escolaridades')->dropDownList($escolaridades, ['prompt'=>'Seleccione...']) ?>

    <?= $form->field($model, 'ultimo_nivel_cursado')->textInput(['maxlength' => true,'placeholder'=> 'Digite el ultmo nivel cursado', 'id' =>'txtNivel']) ?>

    <?= $form->field($model, 'ano_curso')->textInput(['maxlength' => true,'placeholder'=> 'Digite el año del curso', 'id' =>'txtAnoCurso']) ?>

    <?= $form->field($model, 'titulacion')->checkbox() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true,'placeholder'=> 'Digite el título', 'id' =>'txtTitulo']) ?>

    <?= $form->field($model, 'institucion')->textInput(['maxlength' => true,'placeholder'=> 'Digite la institución', 'id' =>'txtInst']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
