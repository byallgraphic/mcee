<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocumentosActividadesVinculacion */

$this->title = 'Agregar Documentos Actividades Vinculacion';
$this->params['breadcrumbs'][] = ['label' => 'Documentos Actividades Vinculacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="documentos-actividades-vinculacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'model' => $model,
         'tiposDocumento'=> $tiposDocumento,
         'instituciones'	=> $instituciones,
         'estados' 		=> $estados,
         'idInstitucion'	=> $idInstitucion,
    ]) ?>

</div>
