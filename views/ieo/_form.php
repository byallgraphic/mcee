

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/ieo.js' ) );

$idTipoInforme = (isset($_GET['idTipoInforme'])) ?  $_GET['idTipoInforme'] :  $model->id_tipo_informe;


?>
<script>
	idTipoInforme = <?php echo $idTipoInforme; ?>;
</script>

<?php 


//triger para calcular los totales de estudiantes y docentes
if( strpos($_GET['r'], 'update') > -1)
{
	echo "	
	<script> 
	

    
	$('div[id *= estudiantesieo],[id *= grado]').each(  function( i, val ) 
	{
		total =0;
		
		//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
		ValId = $(this).attr('id');
		num = ValId.split('-');
		
		//cuando se presione un numero se hace la suma
		$('[id *= estudiantesieo-'+num[1]+'-grado]').each(function( ) 
		{
		  total += $(this).val()*1;
		});

		//se asigna la suma total a la caja de texto correspondiente
		$('#estudiantesieo-'+num[1]+'-total').val(total);
		
	});
	
	</script>";
	
	
	if ($idTipoInforme  != 14)
	{
		
	echo "	
	<script> 
		$('div[id *= tiposcantidadpoblacion],[id *= tiempo_libre],[id *= edu_derechos],[id *= sexualidad],[id *= ciudadania],[id *= medio_ambiente],[id *= familia],[id *= directivos]').each(  function( i, val ) 
		{
			if(idTipoInforme != 14)
			{
				total =0;
				
				// numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
				ValId = $(this).attr('id');
				num = ValId.split('-');
				
				// cuando se presione un numero se hace la suma
				total += $('#tiposcantidadpoblacion-'+num[1]+'-tiempo_libre').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-edu_derechos').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-sexualidad').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-ciudadania').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-medio_ambiente').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-familia').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-directivos').val() * 1 ;
				
				// se asigna la suma total a la caja de texto correspondiente
				$('#tiposcantidadpoblacion-'+num[1]+'-total').val(total);
			}
			
		});
		
		
		</script>";
	}
	
	if ($idTipoInforme  == 14)
	{
		
		echo "	
		<script> 
		$('div[id *= tiposcantidadpoblacion],[id *= docentes],[id *= familia],[id *= directivos]').each(  function( i, val ) 
		{
			if(idTipoInforme == 14)
			{
				total =0;
				
				//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
				ValId = $(this).attr('id');
				num = ValId.split('-');
				
				//cuando se presione un numero se hace la suma
				total += $('#tiposcantidadpoblacion-'+num[1]+'-docentes').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-familia').val() * 1 ;
				total += $('#tiposcantidadpoblacion-'+num[1]+'-directivos').val() * 1 ;
				
				//se asigna la suma total a la caja de texto correspondiente
				$('#tiposcantidadpoblacion-'+num[1]+'-total').val(total);
			
			}
		});
		
		</script>";
	}
		
	
	
	
	
}
?>


<div class="ieo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'zonas_educativas_id')->dropDownList( $zonasEducativas ) ?>

    <?= $form->field($model, 'comuna')->dropDownList( $comunas, [ 'prompt' => 'Seleccione...',  
                'onchange'=>'
                    $.post( "index.php?r=ieo/lists&id="+$(this).val(), function( data ) {
                    $( "select#ieo-barrio" ).html( data );
                    });' ] ) ?>

    <?= $form->field($model, 'barrio')->dropDownList( [], [ 'prompt' => 'Seleccione...',  ] ) ?>                 
    
  
	<?= $form->field($model, 'persona_acargo')->textInput() ?> 
	
	<?= $form->field($model, 'id_tipo_informe')->hiddenInput(['value'=> $idTipoInforme])->label(false) ?> 
    
    <h3 style='background-color: #ccc;padding:5px;'>I.E.O Avance Ejecución</h3>

    <?= $this->context->actionViewFases($model, $form, isset($datos) ? $datos : 0, isset($model->persona_acargo) ?  $model->persona_acargo : '', $idTipoInforme );   ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
