<?php

/**********
Versión: 001
Fecha: 2018-09-03
Desarrollador: Edwin Molina Grisales
Descripción: RESUMEN OPERATIVO FASES ESTUDIANTES
---------------------------------------
Modificación: 
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
**********/

use yii\helpers\Html;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EcDatosBasicosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RESUMEN OPERATIVO FASES DOCENTES';
$this->params['breadcrumbs'][] = $this->title; 
$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(
	"@web/js/ecresumenoperativofasesdocentes.js", 
	[
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\fedemotta\datatables\DataTablesAsset::className(),
						\fedemotta\datatables\DataTablesTableToolsAsset::className(),
					],
	]
);


$this->registerCssFile(
	"/yii/mcee/web/assets/da3a8eca/css/dataTables.tableTools.css", 
	[
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\fedemotta\datatables\DataTablesAsset::className(),
					],
	]
);
?>
<style>

table > thead >tr > th {
	text-align:center;
}

table, th, td {
   border: 1px solid black;
}

table.dataTable {
    border-collapse: collapse;
}

section.content {
	overflow: auto;
}

</style>

<div class="ec-datos-basicos-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	
	<div class="form-group">
			
			<?= Html::a('Volver', 
										[
											'semilleros/index',
										], 
										['class' => 'btn btn-info']) ?>
					
	</div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<p>
        <?php //echo Html::button('Excel', ['class' => 'btn btn-success', 'onclick' => 'exportar()' ]) ?>
    </p>
</div>
<table id='tb'>
	<thead>
		<tr style='background-color:#ccc;text-align:center;'>
			<th colspan='4' style='border: 1px solid black;'>Datos IEO</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Año</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Profesional A.</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Fecha de inicio del Semillero(dd/mm/aaaa)</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Nombre del Docente</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Nombre de las asignaturas que enseña</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Especialidad de la Media Técnica o Técnica</th>
			<th colspan='40' style='border: 1px solid black;'>Fase I Creaci&oacute;n y prueba</th>
			<th colspan='40' style='border: 1px solid black;'>Fase II Desarrollo e implementaci&oacute;n</th>
			<th colspan='43' style='border: 1px solid black;'>Fase III  (Uso - Aplicaci&oacute;n)</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>TOTAL NUMERO DE SESIONES FASES I A III </th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>TOTAL DOCENTES PARTICIPANTES DE FASE I A III</th>
		</tr>
		<tr style='background-color:#ccc'>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>CODIGO DANE IEO</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Instituci&oacute;n educativa</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>CODIGO DANE SEDE</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Sede</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Promedio de duraci&oacute;n por cada sesi&oacute;n (hora reloj)</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 1</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 2</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 3</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 4</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 5</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 6</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 7</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 8</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 9</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 10</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 11</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 12</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 creadas</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Duraci&oacute;n por cada sesi&oacute;n (horas reloj)</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 1</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 2</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 3</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 4</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 5</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 6</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 7</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 8</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 9</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 10</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 11</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 12</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 desarrolladas e implementadas</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Promedio de duración por cada sesión (hora reloj))</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 1</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 2</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 3</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 4</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 5</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 6</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 7</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 8</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 9</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 10</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 11</th>
			<th colspan='3' rowspan='1' style='border: 1px solid black;'>Sesi&oacute;n 12</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 usadas</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Nombres asignaturas en las que uso la App</th>
			<th colspan='2' rowspan='1' style='border: 1px solid black;'>Participantes del uso de la App</th>
		</tr>
		<tr style='background-color:#ccc'>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>	
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Docentes por sesión</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Fecha</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Duraci&oacute;n</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>N&uacute;mero de estudiantes</th>
			<th colspan='1' rowspan='1' style='border: 1px solid black;'>Grado de estudiantes</th>
			
		</tr>
	</thead>
	<tbody>
			
			 <?= $this->context->actionObtenerInfo(); ?>
			</div>
	</tbody>
</table>
