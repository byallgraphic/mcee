<?php

/**********
Versión: 001
Fecha: 2018-09-06
Desarrollador: Edwin Molina Grisales
Descripción: Instrumento población estudiantes
---------------------------------------
*/

use yii\helpers\Html;
// use fedemotta\datatables\DataTables;
use yii\grid\GridView;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;




/* @var $this yii\web\View */
/* @var $searchModel app\models\InstrumentoPoblacionEstudiantesBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instrumento Población Estudiantes';
$this->params['breadcrumbs'][] = $this->title;

// $printInstitucion = true;

$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
	"@web/js/instrumentoPoblacionEstudiantesIndex.js",
	[
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\fedemotta\datatables\DataTablesAsset::className(),
						\fedemotta\datatables\DataTablesTableToolsAsset::className(),
					],
	]
);

?>

<style>
	thead > tr > th {
		background-color: #ccc;
	}
</style>

<div class="instrumento-poblacion-estudiantes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<table id='tbInfo'>
		<thead>
			<tr>
				<th style='border: 1px solid black;'>CODIGO DANE IEO</th>
				<th style='border: 1px solid black;'>Institución educativa</th>
				<th style='border: 1px solid black;'>CODIGO DANE SEDE</th>
				<th style='border: 1px solid black;'>Sede</th>
				<th style='border: 1px solid black;'>Nombre de la Sede</th>
				<th style='border: 1px solid black;'>Nombre y Apellido estudiante(s)</th>
				<th style='border: 1px solid black;'>Sexo</th>
				<th style='border: 1px solid black;'>Número de identificación</th>
				<th style='border: 1px solid black;'>Edad</th>
				<th style='border: 1px solid black;'>Grado</th>
				<th style='border: 1px solid black;'>Curso</th>
				<th style='border: 1px solid black;'>Jornada</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $datos as $d ) : ?>
				<tr>
				<?php 
					$printInstitucion = true; 
					$i = 1;
				?>
				<?php foreach( $d as $data ) : ?>
					
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['institucion']->codigo_dane ?></td>
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['institucion']->descripcion ?></td>
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['sede']->codigo_dane ?></td>
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['sede']->sede_principal ?></td>
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['sede']->descripcion ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['nombres'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['genero'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['identificacion'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['edad'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['grupo'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['curso'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['jornada'] ?></td>
						<?php 
							
							$printInstitucion = false;
							$i++
							
						?>
				</tr>
				<?php endforeach ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
