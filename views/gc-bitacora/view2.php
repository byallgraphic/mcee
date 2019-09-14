<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $model app\models\GcBitacora */

$this->title = "Listado de semanas del ciclo de acompañamiento";
$this->params['breadcrumbs'][] = ['label' => 'Bitacora', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

?>
<div class="gc-bitacora-view">

    <h1><?= Html::encode($this->title)  ?></h1>

	
	<?php try { ?>
        <?=
        DataTables::widget([
            'dataProvider' => $dataProvider,
            'clientOptions' => [
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
                ],
                "lengthMenu" => [[20, -1], [20, Yii::t('app', "All")]],
                "info" => true,
                "responsive" => true,
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',

                'descripcion',
                'fecha_inicio',
                'fecha_finalizacion',
                'fecha_cierre',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{gc-momento1/create},{gc-momento2/create},{gc-momento3/create}',
                    'buttons' => [
                        'gc-momento1/create' => function ($url, $model) { 
                            return Html::a( '<span class="btn btn-xs btn-primary m-t-5">Momento 1</span>', $url, [
                            ]); 
                        },
                        'gc-momento2/create' => function ($url, $model) {
                            return Html::a( '<span class="btn btn-xs btn-primary m-t-5">Momento 2</span>', $url, [
                            ]);
                        },
                        'gc-momento3/create' => function ($url, $model) {
                            return Html::a( '<span class="btn btn-xs btn-primary m-t-5">Momento 3</span>', $url, [
                            ]);
                        },
                    ],

                ],
            ],
        ]);
         ?>
    <?php } catch (Exception $e) {
        var_dump($e);
    }   ?>
</div>
<div class="row">
  <div class="col-xs-6 col-md-4"></div>
  <div class="col-xs-6 col-md-4"><?= Html::a( '<span class="btn btn-xs btn-primary m-t-5">Momento 4</span>', 'index.php?r=gc-momento4/create&id=1', []); ?></div>
  <div class="col-xs-6 col-md-4"></div>
</div>
