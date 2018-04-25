<?php

use yii\helpers\Html;

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/distribucionesAcademicas.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.dataTables.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
 

 

?>
<script>

</script>

<?php
/* @var $this yii\web\View */
/* @var $model app\models\DistribucionesAcademicas */
$this->title = 'Agregar';
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
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuciones-academicas-create">

   <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'idSedes' => $idSedes,
		'estados'=>$estados,
		'docentes'=>$docentes,
		'aulas'=>$aulas,
		'paralelos_distribucion'=>$paralelos_distribucion,
		'modificar'=>$modificar,
		'niveles_sede'=>'',
		'asignaturas_distribucion'=>'',
		'idInstitucion' => $idInstitucion,
		'dataProvider'=> $dataProvider,
    ]) ?>

</div>
