<?php

/**********
Versión: 001
Fecha: 2018-09-03
Desarrollador: Edwin Molina Grisales
Descripción: RESUMEN OPERATIVO FASES ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
---------------------------------------
**********/

use yii\helpers\Html;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EcDatosBasicosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RESUMEN OPERATIVO FASES ESTUDIANTES';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(
	"@web/js/ecresumenoperativofasesestudiantes.js", 
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
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Profesional A.</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>Fecha de inicio del Semillero</th>
			<th colspan='<?= 7 ?>' style='border: 1px solid black;'>Fase I Creaci&oacute;n y prueba</th>
			<th colspan='<?= 7 ?>' style='border: 1px solid black;'>Fase II Desarrollo e implementaci&oacute;n</th>
			<th colspan='<?= 5 ?>' style='border: 1px solid black;'>Fase III  (Uso - Aplicaci&oacute;n)</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>TOTAL PARTICIPANTES FASES I A III (PROMEDIO)</th>
			<th colspan='1' rowspan='3' style='border: 1px solid black;'>TOTAL NUMERO DE SESIONES FASES I A III</th>
		</tr>
		<tr style='background-color:#ccc'>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>CODIGO DANE IEO</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Instituci&oacute;n educativa</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>CODIGO DANE SEDE</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Sede</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Duraci&oacute;n promedio sesiones (horas reloj)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Curso de los Participantes</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de estudiantes participantes (Promedio)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 creadas y probadas</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Duraci&oacute;n por cada sesi&oacute;n (horas reloj)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Curso de los Participantes</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de estudiantes participantes (Promedio)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 desarrolladas e implementadas</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Frecuencia sesiones mensual</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Duraci&oacute;n por cada sesi&oacute;n (horas reloj)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Curso de los Participantes</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>Total Sesiones</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de estudiantes participantes (Promedio)</th>
			<th colspan='1' rowspan='2' style='border: 1px solid black;'>N&uacute;mero de Apps 0.0 usadas</th>
		</tr>
		<tr style='background-color:#ccc'>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($data as $key => $value) {
				?>
					<tr>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['codigo_dane_institucion'] ) ? $value['datos_ieo']['codigo_dane_institucion']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['institucion'] ) ? $value['datos_ieo']['institucion']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['codigo_dane_sede'] ) ? $value['datos_ieo']['codigo_dane_sede']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['sede'] ) ? $value['datos_ieo']['sede']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['nombre_profesional'] ) ? $value['datos_ieo']['nombre_profesional']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['datos_ieo']['fecha_inicio_semillero'] ) ? $value['datos_ieo']['fecha_inicio_semillero']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_1']['frecuencia_sesion'] ) ? $value['fase_1']['frecuencia_sesion']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_1']['duracion_promedio'] ) ? $value['fase_1']['duracion_promedio']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_1']['cursos'] ) ? $value['fase_1']['cursos']  : '' ?></td>
                        <!--sesiones fase 1 -->
                        <td style='border: 1px solid black;'><?= isset($value['fase_2']['frecuencia_sesion'] ) ? $value['fase_2']['frecuencia_sesion']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_2']['duracion_promedio'] ) ? $value['fase_2']['duracion_promedio']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_2']['cursos'] ) ? $value['fase_2']['cursos']  : '' ?></td>
                        <!--sesiones fase 2 -->
                        <td style='border: 1px solid black;'><?= isset($value['fase_3']['frecuencia_sesion'] ) ? $value['fase_2']['frecuencia_sesion']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_3']['duracion_promedio'] ) ? $value['fase_2']['duracion_promedio']  : '' ?></td>
                        <td style='border: 1px solid black;'><?= isset($value['fase_3']['cursos'] ) ? $value['fase_2']['cursos']  : '' ?></td>
                        <!--sesiones fase 3 -->
                    </tr>
				<?php
			}
		?>
	</tbody>
</table>
