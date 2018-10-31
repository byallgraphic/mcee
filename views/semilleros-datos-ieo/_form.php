<?php

/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO
---------------------------------------
Modificaciones:
Fecha: 2018-10-29
Persona encargada: Edwin Molina Grisales
Descripción: Se agrega campos ocultos nuevos
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->registerJsFile(
    '@web/js/semillerosDatosIEO.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);


if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}


/* @var $this yii\web\View */
/* @var $model app\models\SemillerosDatosIeo */
/* @var $form yii\widgets\ActiveForm */
?>

<datalist id='list_persona_a'>
	<?php foreach( $profesionales as $data ) :?>
		<option value='<?=$data?>'>
	<?php endforeach; ?>
</datalist>

<datalist id='list_docente_aliado'>
	<?php foreach( $docentes_aliados as $key => $data ) :?>
		<option value='<?=$data?>' <?=$key?> >
	<?php endforeach; ?>
</datalist>

<div class="semilleros-datos-ieo-form">

	<h3 style='background-color: #ccc;padding:5px;'>DATOS IEO</h3>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($datosIEO, 'id_institucion')->dropDownList([ $institucion->codigo_dane => $institucion->codigo_dane ])->label( 'Código DANE' ) ?>
    
	<?= $form->field($datosIEO, 'id_institucion')->dropDownList([ $institucion->id => $institucion->descripcion ]) ?>

    <?= $form->field($datosIEO, 'sede')->dropDownList([ $sede->id => $sede->codigo_dane ])->label( 'CÓDIGO DANE SEDE' ) ?>
	
    <?= $form->field($datosIEO, 'sede')->dropDownList([ $sede->id => $sede->descripcion ]) ?>

    <?= $form->field($datosIEO, 'personal_a')->textInput([ 
									'list' => 'list_persona_a',
									'autocomplete' => 'off',
								]) ?>

    <?= $form->field($datosIEO, 'docente_aliado')->textInput([ 
									'maxlength' => true, 
									'list' => 'list_docente_aliado',
									'autocomplete' => 'off',
								]) ?>
    
	<?= $form->field($datosIEO, 'id')->hiddenInput()->label( null,[ 'style' => 'display:none' ] ) ?>
	
	<?= Html::hiddenInput( 'guardar', 1, [ 'id' => 'guardar', 'value' => 1 ]) ?>
	
	<?= $form->field($ciclo, 'id')->hiddenInput()->label( null , [ 'style' => 'display:none' ] ); ?>
	
	
	<?php
		if( !empty( $datosIEO->personal_a ) && !empty( $datosIEO->docente_aliado ) )
		{
			?><h3 style='background-color: #ccc;padding:5px;'>ACUERDOS INSTITUCIONES (CONFORMACIÓN)</h3><?php
			
			echo $this->render( 'fases',[
				'fases' 		=> $fases,
				'docentes' 		=> $docentes,
				'jornadas' 		=> $jornadas,
				'recursos' 		=> $recursos,
				'parametros' 	=> $parametros,
				'modelos' 		=> $modelos,
				'form' 			=> $form,
			]); 
			
			?>
			<div class="form-group">
				<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
			</div>
			<?php
			
		}
	?>

	
    <?php ActiveForm::end(); ?>

</div>
