<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocumentosPresupuesto */

$this->title = 'Agregar Documentos Presupuesto';
$this->params['breadcrumbs'][] = ['label' => 'Documentos Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="documentos-presupuesto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento'=> $tiposDocumento,
        'instituciones'	=> $instituciones,
		'estados' 		=> $estados,
		'idInstitucion'	=> $idInstitucion,
    ]) ?>

</div>
