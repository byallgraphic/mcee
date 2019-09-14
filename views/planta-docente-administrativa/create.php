<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlantaDocenteAdministrativa */

$this->title = 'Agregar Planta Docente Administrativa';
$this->params['breadcrumbs'][] = ['label' => 'Planta Docente Administrativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="planta-docente-administrativa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
