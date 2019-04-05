<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Permisos */

$this->title = 'Agregar Permisos';
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="permisos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'modulo' => $modulo,
		'perfil' => $perfil,
    ]) ?>

</div>
