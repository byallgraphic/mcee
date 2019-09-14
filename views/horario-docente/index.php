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

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ActiveForm;
use app\models\Sedes;
use fedemotta\datatables\DataTables;


$this->title = 'Horario Docente';
$this->params['breadcrumbs'][] = $this->title;

$idInstitucion 	= $_SESSION['instituciones'][0];
$idSedes 		= $_SESSION['sede'][0];


?>
<script>
idSede =<?php echo $idSedes ;?>;
idInstitucion = <?php echo $idInstitucion ;?>;
idDocente = <?php echo $_SESSION['perfilesxpersonas'];?>;

</script>

<div class="horario-docente-index">

    <h1><?= Html::encode($this->title) ?></h1>

   
<div class="distribuciones-academicas-form">
    
	<?php 
	
	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/horarioDocente.js',['depends' => [\yii\web\JqueryAsset::className()]]);
	
	$form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'id_perfiles_x_personas_docentes')->dropDownList($docentes)->label('Docente') ?>
	
    <?php ActiveForm::end(); ?> 

	<!-- <?php
					//DataTables::widget([		'dataProvider' => $dataProvider,]); 
	?>-->
	
	<?php
					DataTables::widget([
					'dataProvider' => $dataProvider,
					
					
				]); 
	?>
	
	<?= Html::tag('label', "<h2>Horario</h2>", ['id' => 'tablaModulosLabel']) ?>
	<table id="tablaModulos" class="display" cellspacing="0" width="100%" ></table>
	
	
</div>


    
</div>
