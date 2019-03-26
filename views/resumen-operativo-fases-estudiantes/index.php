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
				'anio' => $anio,
				'esDocente' => $esDocente,
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

<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:15px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:15px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-uys7{border-color:inherit;text-align:center}
</style>
<table id="showExcel" class="tg">
    <thead>
        <tr>
            <th class="tg-c3ow" colspan="4" rowspan="2">Datos IEO</th>
            <th class="tg-c3ow" rowspan="3">Profesional A.	</th>
            <th class="tg-c3ow" rowspan="3">Fecha de inicio del Semillero</th>
            <th class="tg-c3ow" colspan="<?= 6 + ($mayorSesion['maxSesionFaseI']*4) ?>">fase I</th>
            <th class="tg-uys7" colspan="<?= 6 + ($mayorSesion['maxSesionFaseII']*4) ?>">fase 2</th>
            <th class="tg-c3ow" colspan="<?= 6 + ($mayorSesion['maxSesionFaseIII']*4) ?>">Fase 3</th>
            <th class="tg-c3ow" rowspan="3">TOTAL PARTICIPANTES FASES I A III (PROMEDIO)</th>
            <th class="tg-c3ow" rowspan="3">TOTAL NUMERO DE SESIONES FASES I A III</th>
        </tr>
        <tr>
            <td class="tg-c3ow" rowspan="2">Frecuencia sesiones mensual</td>
            <td class="tg-c3ow" rowspan="2">Duración promedio sesiones (horas reloj)</td>
            <td class="tg-c3ow" rowspan="2">Curso de los Participantes</td>
            <?php for ($i=0;$i<$mayorSesion['maxSesionFaseI'];$i++) { ?>
                <td class="tg-0pky" colspan="4">Sesión</td>
            <?php } ?>
            <td class="tg-c3ow" rowspan="2">Total Sesiones</td>
            <td class="tg-c3ow" rowspan="2">Número de participantes por curso en IEO</td>
            <td class="tg-uys7" rowspan="2">Número de Apps 0.0 creadas y probadas</td>
            <td class="tg-uys7" rowspan="2">Frecuencia sesiones mensual</td>
            <td class="tg-uys7" rowspan="2">Duración por cada sesión (horas reloj)</td>
            <td class="tg-uys7" rowspan="2">Curso de los Participantes</td>
            <?php for ($i=0;$i<$mayorSesion['maxSesionFaseII'];$i++) { ?>
                <td class="tg-0pky" colspan="4">Sesión</td>
            <?php } ?>
            <td class="tg-uys7" rowspan="2">Total Sesiones</td>
            <td class="tg-uys7" rowspan="2">Número de participantes por curso en IEO</td>
            <td class="tg-uys7" rowspan="2">Número de Apps 0.0 desarrolladas e implementadas</td>
            <td class="tg-c3ow" rowspan="2">Frecuencia sesiones mensual</td>
            <td class="tg-c3ow" rowspan="2">Duración por cada sesión (horas reloj)</td>
            <td class="tg-c3ow" rowspan="2">Curso de los Participantes</td>
            <?php for ($i=0;$i<$mayorSesion['maxSesionFaseIII'];$i++) { ?>
                <td class="tg-0pky" colspan="4">Sesión</td>
            <?php } ?>
            <td class="tg-c3ow" rowspan="2">Total Sesiones</td>
            <td class="tg-c3ow" rowspan="2">Número de participantes por curso en IEO</td>
            <td class="tg-c3ow" rowspan="2">Número de Apps 0.0 desarrolladas e implementadas</td>
        </tr>
        <tr>
            <td class="tg-c3ow">CODIGO DANE IEO</td>
            <td class="tg-uys7">Institución educativa</td>
            <td class="tg-c3ow">CODIGO DANE SEDE</td>
            <td class="tg-c3ow">Sede</td>

            <?php for ($i=0;$i<($mayorSesion['maxSesionFaseI']+$mayorSesion['maxSesionFaseII']+$mayorSesion['maxSesionFaseIII']);$i++) { ?>
                <td class="tg-0pky"></td>
                <td class="tg-0pky">Fecha</td>
                <td class="tg-0pky">N° Asistentes</td>
                <td class="tg-0pky">Duración</td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $value) { ?>
            <tr>
                <td><?= isset($value['datos_ieo']['codigo_dane_institucion'] ) ? $value['datos_ieo']['codigo_dane_institucion'] : ' '; ?></td>
                <td><?= isset($value['datos_ieo']['institucion'] ) ? $value['datos_ieo']['institucion'] : ' '; ?></td>
                <td><?= isset($value['datos_ieo']['codigo_dane_sede'] ) ? $value['datos_ieo']['codigo_dane_sede'] : ' '; ?></td>
                <td><?= isset($value['datos_ieo']['sede'] ) ? $value['datos_ieo']['sede'] : ' '; ?></td>
                <td><?= isset($value['datos_ieo']['nombre_profesional'] ) ? $value['datos_ieo']['nombre_profesional'] : ' '; ?></td>
                <td><?= isset($value['datos_ieo']['fecha_inicio_semillero'] ) ? $value['datos_ieo']['fecha_inicio_semillero'] : ' '; ?></td>

                <td class="tg-0pky"><?= isset($value['fase_1']['frecuencia_sesion'] ) ? $value['fase_1']['frecuencia_sesion'] : '---'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_1']['duracion_promedio'] ) ? $value['fase_1']['duracion_promedio'] : '---'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_1']['cursos'] ) ? $value['fase_1']['cursos'] : '---'; ?></td>
                <?php if (isset($value['fase_1']["sesiones"])){ ?>
                    <?php foreach ($value['fase_1']["sesiones"] as $keyFI => $sesion) { ?>
                        <td class="tg-0pky"><?= $sesion[0] + 1 ?></td>
                        <td class="tg-0pky"><?= $sesion[1] ?></td>
                        <td class="tg-0pky"><?= $sesion[2] ?></td>
                        <td class="tg-0pky"><?= $sesion[3] ?></td>
                    <?php } ?>
                <?php } ?>
                <td class="tg-0pky"><?= isset($value['fase_1']['total_sesiones'] ) ? $value['fase_1']['total_sesiones'] : 0; ?></td>
                <td class="tg-0lax"><?= isset($value['fase_1']['total_participaciones'] ) ? $value['fase_1']['total_participaciones'] : 0; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_1']['totalapps'] ) ? $value['fase_1']['totalapps'] : 0; ?></td>

                <td class="tg-0pky"><?= isset($value['fase_2']['frecuencia_sesion'] ) ? $value['fase_2']['frecuencia_sesion'] : '---'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_2']['duracion_promedio'] ) ? $value['fase_2']['duracion_promedio'] : '---'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_2']['cursos'] ) ? $value['fase_2']['cursos'] : '---'; ?></td>
                <?php if (isset($value['fase_2']["sesiones"])){ ?>
                    <?php foreach ($value['fase_2']["sesiones"] as $keyFI => $sesion) { ?>
                        <td class="tg-0pky"><?= $sesion[0] + 1 ?></td>
                        <td class="tg-0pky"><?= $sesion[1] ?></td>
                        <td class="tg-0pky"><?= $sesion[2] ?></td>
                        <td class="tg-0pky"><?= $sesion[3] ?></td>
                    <?php } ?>
                <?php } ?>
                <td class="tg-0pky"><?= isset($value['fase_2']['total_sesiones'] ) ? $value['fase_2']['total_sesiones'] : 0; ?></td>
                <td class="tg-0lax"><?= isset($value['fase_2']['total_participaciones'] ) ? $value['fase_2']['total_participaciones'] : 0; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_2']['totalapps'] ) ? $value['fase_2']['totalapps'] : 0; ?></td>


                <td class="tg-0pky"><?= isset($value['fase_3']['frecuencia_sesion'] ) ? $value['fase_3']['frecuencia_sesion'] : '----'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_3']['duracion_promedio'] ) ? $value['fase_3']['duracion_promedio'] : '----'; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_3']['cursos'] ) ? $value['fase_3']['cursos'] : '---'; ?></td>
                <?php if (isset($value['fase_3']["sesiones"])){ ?>
                    <?php foreach ($value['fase_3']["sesiones"] as $keyFI => $sesion) { ?>
                        <td class="tg-0pky"><?= $sesion[0] + 1 ?></td>
                        <td class="tg-0pky"><?= $sesion[1] ?></td>
                        <td class="tg-0pky"><?= $sesion[2] ?></td>
                        <td class="tg-0pky"><?= $sesion[3] ?></td>
                    <?php } ?>
                <?php } ?>
                <td class="tg-0pky"><?= isset($value['fase_3']['total_sesiones'] ) ? $value['fase_3']['total_sesiones'] : 0; ?></td>
                <td class="tg-0lax"><?= isset($value['fase_3']['total_participaciones'] ) ? $value['fase_3']['total_participaciones'] : 0; ?></td>
                <td class="tg-0pky"><?= isset($value['fase_3']['totalapps'] ) ? $value['fase_3']['totalapps'] : 0; ?></td>

                <td><?= isset($value['total']['promedio'] ) ? $value['total']['promedio'] : 0; ?></td>
                <td><?= isset($value['total']['suma_fases'] ) ? $value['total']['suma_fases'] : 0; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
