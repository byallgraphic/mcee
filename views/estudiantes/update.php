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



$this->title = 'Actualizar estudiantes';
$this->params['breadcrumbs'][] = 
								[
									'label' => 'Matricular Estudiante', 
									'url' => [
											'index',
										 ]
								];						 
								 
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="estudiantes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados'=>$estados,
		'paralelos'=>$paralelos,
		'estudiantes'=>$estudiantes,
		'idSedes'=>$idSedes,
		'niveles_sede'=>$niveles_sede,
    ]) ?>

</div>
