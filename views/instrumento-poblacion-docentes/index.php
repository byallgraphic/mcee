<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstrumentoPoblacionEstudiantesBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instrumento Población Docentes';
$this->params['breadcrumbs'][] = $this->title;

use fedemotta\datatables\DataTables;

$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
	"@web/js/instrumentoPoblacionDocentesIndex.js",
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
				<th style='border: 1px solid black;'>Nombre de la Sede</th>
				<th style='border: 1px solid black;'>Nombre y Apellido Docente(s)</th>
				<th style='border: 1px solid black;'>Sexo</th>
				<th style='border: 1px solid black;'>Número de identificación</th>
				<th style='border: 1px solid black;'>Edad</th>
				<th style='border: 1px solid black;'>Profesión</th>
				<th style='border: 1px solid black;'>Ultimo nivel de formación (pregrado, especialización, maestría, doctorado)</th>
				<th style='border: 1px solid black;'>Escalafon</th>
				<th style='border: 1px solid black;'>Asignaturas que enseña</th>
				<th style='border: 1px solid black;'>Grados en los que enseña</th>
				<th style='border: 1px solid black;'>Jornada en la que enseña</th>
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
						<td rowspan='<?= count( $d ) ?>' <?= !$printInstitucion ? "style='display:none'" : "style='border-bottom: 1px solid black;'" ?>><?= $data['sede']->descripcion ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['docente']->nombres." ".$data['docente']->apellidos ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['genero'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['docente']->identificacion ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['edad'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['profesion'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['formacion'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'><?= $data['escalafon'] ?></td>
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'>
						
						<?php foreach( $data['asignaturas'] as $value ) : ?>
							<?= $value."<br>" ?>
						<?php endforeach ?>
						</td>
						
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'>
						<?php foreach( $data['grados'] as $value ) : ?>
							<?= $value."<br>" ?>
						<?php endforeach ?>
						</td>
						
						<td style='<?= $i == count( $d ) ? "border-bottom: 1px solid black;": '' ?>'>
						<?php foreach( $data['jornadas'] as $value ) : ?>
							<?= $value."<br>" ?>
						<?php endforeach ?>
						</td>
						
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
