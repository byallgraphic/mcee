<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbCalendario */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Pcc Tb Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="pcc-tb-calendario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Borrar', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Fecha_captura',
            'Nmero_de_identificacin_del_Tutor',
            'Nombre',
            'Apellido',
            'Institucin_Educativa',
            'Sede',
            'Fecha_de_programacin',
            'Hora_inicio',
            'Hora_final',
            'Actividad:ntext',
            'Cantidad_de_refrigerios_requerid',
            'Seguimiento_pedagogico',
            'Estado_del_evento',
            'Fecha_reprogramacion',
            'Motivo_reprogramacion:ntext',
            'Perfi',
            'Lugar_reunion_as',
            'Requiere_refrigerios',
            'Taller',
            'Laboratorio',
        ],
    ]) ?>

</div>
