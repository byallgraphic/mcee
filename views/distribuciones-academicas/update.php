<?php

use yii\helpers\Html;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/distribucionesAcademicas.js',['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\models\DistribucionesAcademicas */

$this->title = 'Modificar: ';
$this->params['breadcrumbs'][] = [
									'label' => 'Distribuciones Académicas', 
									'url' => [
												'index',
												'idInstitucion' => $idInstitucion, 
												'idSedes' 		=> $idSedes,
											 ]
								 ];
								 
$this->params['breadcrumbs'][] = $this->title;
// $this->params['breadcrumbs'][] = ['label' => 'Distribuciones Academicas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];

?>
<div class="distribuciones-academicas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados'=>$estados,
		'idSedes' => $idSedes,
		'docentes'=>$docentes,
		'aulas'=>$aulas,
		'grupos'=>$grupos,
		'niveles_sede'=>$niveles_sede,
		'asignaturas_distribucion'=>$asignaturas_distribucion,
		'modificar'=>$modificar,
		'idInstitucion' => $idInstitucion,
    ]) ?>

</div>