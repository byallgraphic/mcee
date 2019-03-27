<?php
/**********
Versión: 001
Fecha: Fecha en formato (30-08-2018)
Desarrollador: Viviana Rodas
Descripción: diario de campo estudiantes semilleros tic
******************/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\bootstrap\Collapse;

use app\models\Sesiones;

/* @var $this yii\web\View */
/* @var $model app\models\SemillerosTicDiarioDeCampoEstudiantes */
/* @var $form yii\widgets\ActiveForm */

// var_dump( $dataResumen );

// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/diarioCampoEstudiantes.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/diarioCampoEstudiantes.js' ) );

$items = [];

if( $dataResumen && ( empty( $dataResumen['contenido'] ) || empty( $dataResumen['contenido1'] ) ) ){
	$this->registerJs( "swal('Importante', '".$dataResumen['mensaje']."', 'info');" );
}
?>
<script>
cicloSelected = <?php echo $cicloSelected ? $cicloSelected : "''"; ?>;
</script>


<!-- Se inicia el formulario-->
<?php $form = ActiveForm::begin([ 
						'action'=> Yii::$app->urlManager->createUrl([
											'semilleros-tic-diario-de-campo-estudiantes/create', 
											'anio' 		=> $anio, 
											'esDocente' => $esDocente, 
										]) 
					]); ?>

	<!-- Espacio para seleccionar la fase, ciclo y año-->
	<div class="" style=''>

		<?= $form->field( $diarioCampo, 'anio' )->dropDownList( $anios ) ?>

		<?= $form->field( $diarioCampo, 'id_fase')->dropDownList( $fases, ['prompt'=>'Seleccione...'] )->label("Fase") ?>
	
	</div>
	
	<br>
	
	<!--  div contenedor de todo el formulario y los campos que se muestran-->
	<div id="principal">
	 
		<!-- Espacio para los datos que se cargan desde la base de datos-->
		<div class="" id='titulo' style='padding:0px;background-color:#ccc;height:30px;text-align:center;display:<?= !empty( $dataResumen['titulo'] ) ? '' : 'none' ?>;font-weight: bold;'>
			<?= !empty( $dataResumen['titulo'] ) ? $dataResumen['titulo'] : ''; ?>
		</div>
		
		<br>
		
		<div class="" style='padding:0px;background-color:#ccc;height:30px;text-align:center;font-weight: bold;'>
			RESUMEN CUANTITATIVO DEL RESULTADO
		</div>
		
		<div class="">
		
			<div class="" style='padding:0px;background-color:#ccc;text-align:center;height:100px;display:<?= !empty( $dataResumen['html'] ) ? '' : 'none'; ?>;font-weight: bold;' id="encabezado">
				<?= !empty( $dataResumen['html'] ) ? $dataResumen['html'] : ''; ?>
			</div>
			
			<div class="" style='padding:0px;background-color:white;text-align:center;height:150px;display:<?= !empty( $dataResumen['contenido'] ) ? '' : 'none'; ?>' id="contenido">
				<?= !empty( $dataResumen['contenido'] ) ? $dataResumen['contenido'] : ''; ?>
			</div>
			
			<div class="" style='padding:0px;background-color:#ccc;text-align:center;height:100px;display:<?= !empty( $dataResumen['html1'] ) ? '' : 'none'; ?>;font-weight: bold;' id="encabezado1">
				<?= !empty( $dataResumen['html1'] ) ? $dataResumen['html1'] : ''; ?>
			</div>
			
			<div class="" style='padding:0px;background-color:white;text-align:center;height:150px;display:<?= !empty( $dataResumen['contenido1'] ) ? '' : 'none'; ?>' id="contenido1">
				<?= !empty( $dataResumen['contenido1'] ) ? $dataResumen['contenido1'] : ''; ?>
			</div>

			<!-- formulario -->
			<div class="semilleros-tic-diario-de-campo-estudiantes-form">

				<br>
					<div class="" style='padding:0px;background-color:#ccc;height:30px;text-align:center;font-weight: bold;'>
						Espacio de escritura para el profesional
					</div>
				<br>
				
				
				<?php foreach( $movimientos as $mov ): 
				
					// <div id="descripcion">
						// = !empty( $dataResumen['descripcion'] ) ? $dataResumen['descripcion'] : '';
					// </div>
					
					$item = Html::tag( 'div', !empty( $dataResumen['descripcion'] ) ? $dataResumen['descripcion'] : '', [ 'id' => 'descripcion' ] );
					
					$item .= $form->field($mov, '['.( $index ).']descripcion')->textArea(['maxlength' => true,'placeholder'=> 'Campo de escritura'])->label();
					
					// <div id="hallazgos">
						// = !empty( $dataResumen['hallazgos'] ) ? $dataResumen['hallazgos'] : ''; 
					// </div>
					$item .= Html::tag( 'div', !empty( $dataResumen['hallazgos'] ) ? $dataResumen['hallazgos'] : '', [ 'id' => 'hallazgos' ] );
					
					$item .= $form->field($mov, '['.( $index ).']hallazgos')->textArea(['maxlength' => true,'placeholder'=> 'Campo de escritura'])->label();
					
					$item .= $form->field($mov, '['.( $index ).']id')->hiddenInput()->label( false );
					
					$item .= $form->field($mov, '['.( $index ).']id_sesion')->hiddenInput()->label( false );
					
					$items[] = 	[
									'label' 		=>  Sesiones::findOne( $mov->id_sesion )->descripcion,
									'content' 		=>  $item,
									'contentOptions'=> [],
								];
					
					++$index;
					
					endforeach;
				?>
				
				<?= Collapse::widget([
					'items' => $items,
					'options' => [ "id" => "collapseOne" ],
				]); ?>
				
				<?php echo count( $items) == 0 ? "<div style='text-align:center;font-weight:bold;' >NO SE ENCONTRARON DATOS ALMACENADOS</div>" : ''; ?>

			</div>
		
		</div>

	</div>

	<div class="form-group">
		<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
	</div>
	
<?php ActiveForm::end(); ?>