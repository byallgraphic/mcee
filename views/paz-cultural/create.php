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

$this->title = 'Paz y cultura';
$this->params['breadcrumbs'][] = ['label' => 'Paz y cultura', 'url' => ['index', 'idInstitucion' => $idInstitucion, 'tipo_documento' => $tipo_perfil ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 		=> $model,
        'tipoPerfil'=> $tipoPerfil,
        'instituciones'	=> $instituciones,
		'estados' 		=> $estados,
		'idInstitucion'	=> $idInstitucion,
		'tipo_perfil'	=> $tipo_perfil,
    ]) ?>

</div>
