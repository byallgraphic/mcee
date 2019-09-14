<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocumentosRelacionesSector */

$this->title = 'Agregar Documentos Relaciones Sector';
$this->params['breadcrumbs'][] = ['label' => 'Documentos Relaciones Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="documentos-relaciones-sector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
        'instituciones'	 => $instituciones,
        'estados' 		 => $estados,
        'idInstitucion'	 => $idInstitucion,
    ]) ?>

</div>
