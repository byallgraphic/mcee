<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcInformeEjecutivoEstado */

$idTipoInforme = $_GET['idTipoInforme'];

$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select p.id
			from ec.tipo_informe as ti, ec.componentes as c, ec.proyectos as p
			where ti.id = $idTipoInforme
			and ti.id_componente = c.id
			and c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		

//colores del acordeon
		$arrayColores = array
		(
			1=>"bg-danger",
			3=>"bg-info",
			2=>"bg-success",
			4=>"bg-warning"
		);
		
		$color = $arrayColores[$ecProyectos[0]['id']];

$this->title = 'Ingresar la información';
$this->params['breadcrumbs'][] = ['label' => 'Informe Ejecutivo Estado', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";

?>
<div class="ec-informe-ejecutivo-estado-create">

    <h1 class='<?php echo $color; ?>'><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'persona' =>$persona,
		'coordinador' =>$coordinador,
		'secretario' =>$secretario,
		'instituciones'=> $instituciones,
		'ejes'=> $ejes,
    ]) ?>

</div>
