<?php
/**********
Modificación: 
Fecha: 23-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver al index donde estan los botones de competencias basicas - proyecto
---------------------------------------

**********/
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */

$this->title = 'Datos básicos';
$this->params['breadcrumbs'][] = ['label' => 'Planeación', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";

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
?>

<div class="ec-datos-basicos-create">

    <h1 class='<?php echo $color; ?>'><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelDatosBasico' 	=> $modelDatosBasico,
		'modelPlaneacion' 	=> $modelPlaneacion,
		'modelVerificacion' => $modelVerificacion,
		'modelReportes' 	=> $modelReportes,
		'tiposVerificacion'	=> $tiposVerificacion,
		'profesional'		=> $profesional,
		'sede'				=> $sede,
		'institucion'		=> $institucion,
    ]) ?>

</div>
