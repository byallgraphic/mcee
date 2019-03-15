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

<?php $noSesionI = $mayorSesion['maxSesionFaseI']; ?>
<?php $noSesionII = $mayorSesion['maxSesionFaseII']; ?>
<?php $noSesionIII = $mayorSesion['maxSesionFaseIII']; ?>
<?php if ($mayorSesion['maxSesionFaseI'] == 0){
    $noSesionI = -1;
} ?>
<?php if ($mayorSesion['maxSesionFaseII'] == 0){
    $noSesionII = -1;
} ?>
<?php if ($mayorSesion['maxSesionFaseIII'] == 0){
    $noSesionIII = -1;
} ?>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:15px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:15px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-uys7{border-color:inherit;text-align:center}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
</style>
<table id="datosieo" class="tg">
    <thead>
    <tr>
        <th colspan="4">Datos IEO</th>
        <th rowspan="2">Profesional A.</th>
        <th rowspan="2">Fecha de inicio del Semillero</th>
        <th rowspan="2">TOTAL PARTICIPANTES FASES I A III (PROMEDIO)</th>
        <th rowspan="2">TOTAL NUMERO DE SESIONES FASES I A III</th>
    </tr>
    <tr>
        <td>CODIGO DANE IEO</td>
        <td>Institución educativa</td>
        <td>CODIGO DANE SEDE</td>
        <td>Sede</td>
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
            <td><?= isset($value['total']['promedio'] ) ? $value['total']['promedio'] : ' '; ?></td>
            <td><?= isset($value['total']['suma_fases'] ) ? $value['total']['suma_fases'] : ' '; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br>
<br>
<br>

<?php $noSesionI = $mayorSesion['maxSesionFaseI']; ?>
<?php $noSesionII = $mayorSesion['maxSesionFaseII']; ?>
<?php $noSesionIII = $mayorSesion['maxSesionFaseIII']; ?>
<?php if ($mayorSesion['maxSesionFaseI'] == 0){
    $noSesionI = -1;
} ?>
<?php if ($mayorSesion['maxSesionFaseII'] == 0){
    $noSesionII = -1;
} ?>
<?php if ($mayorSesion['maxSesionFaseIII'] == 0){
    $noSesionIII = -1;
} ?>

<table id="fase1" class="tg">
    <thead>
    <tr>
        <th class="tg-0pky" colspan="<?= 10 + ($noSesionI*4) ?>">Fase I Creación y prueba</th>
    </tr>
    <tr>
        <td class="tg-0pky" rowspan="2">Frecuencia sesiones mensual</td>
        <td class="tg-0pky" rowspan="2">Duración promedio sesiones (horas reloj)</td>
        <td class="tg-0pky" rowspan="2">Curso de los Participantes</td>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseI'];$i++) { ?>
            <td class="tg-0pky" colspan="4">Sesión 1</td>
        <?php } ?>
        <td class="tg-0pky" rowspan="2">Total Sesiones</td>
        <td class="tg-0pky" rowspan="2">Número de participantes por curso en IEO</td>
        <td class="tg-0pky" rowspan="2">Número de Apps 0.0 creadas y probadas</td>
    </tr>
    <tr>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseI'];$i++) { ?>
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
            <td class="tg-0pky"><?= isset($value['fase_1']['frecuencia_sesion'] ) ? $value['fase_1']['frecuencia_sesion'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_1']['duracion_promedio'] ) ? $value['fase_1']['duracion_promedio'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_1']['cursos'] ) ? $value['fase_1']['cursos'] : ' '; ?></td>
            <?php if (isset($value['fase_1']["sesiones"])){ ?>
                <?php foreach ($value['fase_1']["sesiones"] as $keyFI => $sesion) { ?>
                    <td class="tg-0pky"><?= $sesion[0] ?></td>
                    <td class="tg-0pky"><?= $sesion[1] ?></td>
                    <td class="tg-0pky"><?= $sesion[2] ?></td>
                    <td class="tg-0pky"><?= $sesion[3] ?></td>
                <?php } ?>
            <?php } ?>
            <td class="tg-0pky"><?= isset($value['fase_1']['total_sesiones'] ) ? $value['fase_1']['total_sesiones'] : ' '; ?></td>
            <td class="tg-0lax"><?= isset($value['fase_1']['total_participaciones'] ) ? $value['fase_1']['total_participaciones'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_1']['totalapps'] ) ? $value['fase_1']['totalapps'] : ' '; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<table class="tg">
    <thead>
    <tr>
        <th class="tg-0pky" colspan="<?= 10 + ($noSesionII*4) ?>">Fase II Desarrollo e implementación</th>
    </tr>
    <tr>
        <td class="tg-0pky" rowspan="2">Frecuencia sesiones mensual</td>
        <td class="tg-0pky" rowspan="2">Duración promedio sesiones (horas reloj)</td>
        <td class="tg-0pky" rowspan="2">Curso de los Participantes</td>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseII'];$i++) { ?>
            <td class="tg-0pky" colspan="4">Sesión 1</td>
        <?php } ?>
        <td class="tg-0pky" rowspan="2">Total Sesiones</td>
        <td class="tg-0pky" rowspan="2">Número de participantes por curso en IEO</td>
        <td class="tg-0pky" rowspan="2">Número de Apps 0.0 creadas y probadas</td>
    </tr>
    <tr>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseII'];$i++) { ?>
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
            <td class="tg-0pky"><?= isset($value['fase_2']['frecuencia_sesion'] ) ? $value['fase_2']['frecuencia_sesion'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_2']['duracion_promedio'] ) ? $value['fase_2']['duracion_promedio'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_2']['cursos'] ) ? $value['fase_2']['cursos'] : ' '; ?></td>
            <?php if (isset($value['fase_2']["sesiones"])){ ?>
                <?php foreach ($value['fase_2']["sesiones"] as $keyFI => $sesion) { ?>
                    <td class="tg-0pky"><?= $sesion[0] ?></td>
                    <td class="tg-0pky"><?= $sesion[1] ?></td>
                    <td class="tg-0pky"><?= $sesion[2] ?></td>
                    <td class="tg-0pky"><?= $sesion[3] ?></td>
                <?php } ?>
            <?php } ?>
            <td class="tg-0pky"><?= isset($value['fase_2']['total_sesiones'] ) ? $value['fase_2']['total_sesiones'] : ' '; ?></td>
            <td class="tg-0lax"><?= isset($value['fase_2']['total_participaciones'] ) ? $value['fase_2']['total_participaciones'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_2']['totalapps'] ) ? $value['fase_2']['totalapps'] : ' '; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<table class="tg">
    <thead>
    <tr>
        <th class="tg-0pky" colspan="<?= 10 + ($noSesionIII*4) ?>">Fase III  (Uso - Aplicación)</th>
    </tr>
    <tr>
        <td class="tg-0pky" rowspan="2">Frecuencia sesiones mensual</td>
        <td class="tg-0pky" rowspan="2">Duración promedio sesiones (horas reloj)</td>
        <td class="tg-0pky" rowspan="2">Curso de los Participantes</td>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseIII'];$i++) { ?>
            <td class="tg-0pky" colspan="4">Sesión 1</td>
        <?php } ?>
        <td class="tg-0pky" rowspan="2">Total Sesiones</td>
        <td class="tg-0pky" rowspan="2">Número de participantes por curso en IEO</td>
        <td class="tg-0pky" rowspan="2">Número de Apps 0.0 creadas y probadas</td>
    </tr>
    <tr>
        <?php for ($i=0;$i<$mayorSesion['maxSesionFaseIII'];$i++) { ?>
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
            <td class="tg-0pky"><?= isset($value['fase_3']['frecuencia_sesion'] ) ? $value['fase_3']['frecuencia_sesion'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_3']['duracion_promedio'] ) ? $value['fase_3']['duracion_promedio'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_3']['cursos'] ) ? $value['fase_3']['cursos'] : ' '; ?></td>
            <?php if (isset($value['fase_3']["sesiones"])){ ?>
                <?php foreach ($value['fase_3']["sesiones"] as $keyFI => $sesion) { ?>
                    <td class="tg-0pky"><?= $sesion[0] ?></td>
                    <td class="tg-0pky"><?= $sesion[1] ?></td>
                    <td class="tg-0pky"><?= $sesion[2] ?></td>
                    <td class="tg-0pky"><?= $sesion[3] ?></td>
                <?php } ?>
            <?php } ?>
            <td class="tg-0pky"><?= isset($value['fase_3']['total_sesiones'] ) ? $value['fase_3']['total_sesiones'] : ' '; ?></td>
            <td class="tg-0lax"><?= isset($value['fase_3']['total_participaciones'] ) ? $value['fase_3']['total_participaciones'] : ' '; ?></td>
            <td class="tg-0pky"><?= isset($value['fase_3']['totalapps'] ) ? $value['fase_3']['totalapps'] : ' '; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>