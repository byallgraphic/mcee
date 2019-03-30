<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Implementacion Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="implementacion-ieo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'zonasEducativas' => $zonasEducativas,
        'datos'=> $datos,
		'sede' => $sede,
		'institucion'=> $institucion,
		'comunas' => $comunas, 
		'nombres' => $nombres, 
		
    ]) ?>

</div>
