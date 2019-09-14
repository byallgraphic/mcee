<?php
/**********
Versión: 001
Fecha: 03-01-2019
Desarrollador: Edwin Molina Grisales
Descripción: CRUD Consolidado por mes - Misional
---------------------------------------
**********/

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IsaEncArtisticaMisional */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$titles	  =	[
				0 => "Sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio.",
				1 => "Desarrollar programas de iniciación y sensibilización artística desde las instituciones educativas oficiales dirigidos a la comunidad.",
			];
			
$titleMision  = [
					0 => "Personas de la comunidad (líderes, organizaciones de base, población no escolar, etc.) capacitadas en procesos de iniciación y sensibilización artística.",
					1 => "Instituciones educativas que integran estrategias de iniciación y sensibilización artística para fortalecer la creación de proyectos específicos con la comunidad (líderes, organizaciones de base, población no escolar, etc.). Para enriquecer el proceso formativo de niños, niñas, adolescentes y jóvenes, al año.",
				];
				
$this->registerJsFile(
    '@web/js/isaEncArtisticaMisional.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);

if( !$sede ){
	
	exit( "<div class='btn-danger' style='font-size:20pt;text-align:center;width:100%;'>Por favor seleccione una sede</div>" );
}
			
if( $guardado === true )
{
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}
?>

<style>
h3 {
	background-color: #ccc;
	padding			: 5px;
}

h4 {
	background-color: #ccc;
	padding			: 3px;
}
</style>

<div class="isa-enc-artistica-misional-form">

    <?php $form = ActiveForm::begin(['action' => Url::to( ['create'] )]); ?>

    <?= Html::hiddenInput('guardar', 1 ) ?>
	
    <?= Html::activeHiddenInput($models['encabezado'], 'id') ?>
	
    <?= $form->field($models['encabezado'], 'id_institucion')->dropDownList([ $institucion->id => $institucion->descripcion ]) ?>

    <?= $form->field($models['encabezado'], 'id_sede')->dropDownList([ $sede->id => $sede->descripcion ]) ?>

    <?= $form->field($models['encabezado'], 'periodo')->textInput() ?>

    <?= $form->field($models['encabezado'], 'fecha')->widget(
			DatePicker::className(), [
				// modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format'    => 'yyyy-mm-dd',
			],
		]); ?>
	
	
	<?php 
		$index = 0;
	
		foreach( $models['detalle'] as $key => $detalle )
		{
			echo "<h3>".$titles[$key]."</h3>";
			
			echo $this->render( 'detalle',
						[
							'form' 			=> $form,
							'models' 		=> $detalle,
							'index' 		=> $index,
							'indicadores' 	=> $indicadores[$key],
							'actividades' 	=> $actividades[$key],
							'titleMision' 	=> $titleMision[$key],
						]
					);
			$index++;
		}
	?>
	

	<?php if( !$guardado ) : ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
	
	<?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
