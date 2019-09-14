<?php

/**********
Versión: 001
Fecha: 2018-10-01
Desarrollador: Edwin MG
Descripción: Archivo Create de Gestion Comunitaria
---------------------------------------
*/

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
/* @var $model app\models\Documentos */

$this->title = 'Documentos Gestión Comunitaria';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index', 'idInstitucion' => $idInstitucion, 'tipo_documento' => $tipo_documento_comunitario ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 		=> $model,
        'tiposDocumento'=> $tiposDocumento,
        'instituciones'	=> $instituciones,
		'estados' 		=> $estados,
		'idInstitucion'	=> $idInstitucion,
		'tipo_documento_comunitario'	=> $tipo_documento_comunitario,
    ]) ?>

</div>
