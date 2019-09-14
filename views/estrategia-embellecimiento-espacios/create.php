<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstrategiaEmbellecimientoEspacios */

$this->title = 'Agregar Estrategia Embellecimiento Espacios';
$this->params['breadcrumbs'][] = ['label' => 'Estrategia Embellecimiento Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="estrategia-embellecimiento-espacios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parametrosUsos' => $parametrosUsos,
        'parametrosEmbellecimiento' => $parametrosEmbellecimiento,
        'tiposDocumento' => $tiposDocumento,
        'instituciones'	 => $instituciones,
        'estados' 		 => $estados,
        'idInstitucion'	 => $idInstitucion,
    ]) ?>

</div>
