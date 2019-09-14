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
use app\models\Sedes;
use	yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\DirectorParalelo */

$this->title = 'Agregar director de grupo';
$this->params['breadcrumbs'][] = [
								'label' => 'Asignaturas', 
								'url' => [
											'index',
										 ]
							 ];		
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="director-paralelo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'idSedes' => $idSedes,
		'grupos'=>$grupos,
		'docentes'	=>$docentes
    ]) ?>

</div>
