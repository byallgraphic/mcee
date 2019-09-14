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

/**********
Versión: 001
Fecha: 09-04-2018
Persona encargada: Edwin Molina Grisales
CRUD de RECURSOS DE INFRAESTRUCTURA PEDAGOGICA
---------------------------------------
**********/

use yii\helpers\Html;

use	yii\helpers\ArrayHelper;
use app\models\Sedes;


/* @var $this yii\web\View */
/* @var $model app\models\RecursoInfraestructuraPedagogica */

$this->title = 'Agregar Recurso de Infraestructura Pedagógica';
$this->params['breadcrumbs'][] = [
									'label' => 'Recurso Infraestructura Pedagogicas',
									'url' => [
												'index',
											 ],
								 ];	
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recurso-infraestructura-pedagogica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 	=> $model,
		'sedes' 	=> $sedes,
		'estados'	=> $estados,
    ]) ?>

</div>
