<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;


use app\models\Personas;
use nex\chosen\Chosen;

$estudiantesTable = Personas::find()
						->select( "personas.id, ( identificacion || ' ' || nombres || ' ' || apellidos ) as nombres" )
						->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
						->innerJoin( 'estudiantes e', 'e.id_perfiles_x_personas=pp.id' )
						->where( 'personas.estado=1' )
						->andWhere( 'pp.estado=1' )
						->all();
						
$estudiantes = ArrayHelper::map( $estudiantesTable, 'id', 'nombres' );
// var_dump($estudiantes);

/* @var $this yii\web\View */
/* @var $model app\models\HojaVidaEstudianteBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hoja-vida-estudiante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

	
	<?= $form->field($model, 'id')->widget(
		Chosen::className(), [
			'items' => $estudiantes,
			'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
			'placeholder' => 'Seleccione...',
			'clientOptions' => [
				'search_contains' => true,
				'single_backstroke_delete' => false,
			],
		])->label('Estudiantes');
	?>
	
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>