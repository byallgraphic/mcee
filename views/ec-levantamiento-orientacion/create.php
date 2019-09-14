<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcLevantamientoOrientacion */

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
$this->params['breadcrumbs'][] = ['label' => 'Levantamiento de orientación misional y método', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-levantamiento-orientacion-create">

    <h1 class='<?php echo $color; ?>'><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones' => $instituciones,
		'estados' =>$estados,
		'parametros' =>$parametros,
		'idTipoInforme' => $idTipoInforme,
    ]) ?>

</div>
