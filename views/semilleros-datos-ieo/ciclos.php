<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title='Seleccione un ciclo';
?>


<?php $form = ActiveForm::begin(); ?>

<div class='row text-center'>
	
	<div class='row text-center'>
		
		<div class='col-sm-4'></div>
		
		<div class='col-sm-4'>
			<h1><?= Html::encode("Ciclos") ?></h1>
	
			<?= $form->field( $model, 'id_anio' )->dropDownList( $anios, [ 
														'prompt' 	=> 'Seleccione...', 
														'onChange' 	=> 'this.form.submit()' 
													] ) ?>

			<?= $form->field( $model, 'id' )->dropDownList( $ciclos, [ 
														'prompt' => 'Seleccione...',
														'onChange' 	=> 'this.form.submit()',
													] )->label( 'Ciclo' ); ?>
	
		</div>
		
		<div class='col-sm-4'></div>
		
	</div>
	
</div>

<?php ActiveForm::end(); ?>