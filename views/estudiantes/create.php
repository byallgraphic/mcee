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


/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
use	yii\helpers\ArrayHelper;
use app\models\Sedes;

$this->title = 'Agregar estudiante';
	$this->params['breadcrumbs'][] = [
									'label' => 'Matricular Estudiante', 
									'url' => [
												'index',
											 ]
								 ];						 
								 
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="estudiantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

	
	
    <?= $this->render('_form', [
        'model' => $model,
		'estudiantes'=>$estudiantes,
		'idSedes'=>$idSedes,	
		'niveles_sede'=>'',
		'estados'=>$estados,
		'paralelos'=>'',
		
    ]) ?>

</div>
