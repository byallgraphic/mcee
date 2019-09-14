<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeSemanalTotalEjecutivo */
/* @var $form yii\widgets\ActiveForm */
//$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

if( isset($_GET['guardado']) && $_GET['guardado'] == 1 ){    
    echo Html::hiddenInput( 'guardado', '1' );
}

$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(
	"@web/js/ecresumensemanalEjecutivo.js", 
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
    
    table {
		width:90%;
		border-top:1px solid #e5eff8;
		border-right:1px solid #e5eff8;
		margin:1em auto;
		border-collapse:collapse;
    }
	
    td {
		color:#678197;
		border: 1px solid #000;
		padding:.3em 1em;
		text-align:left;
    }
	
	thead > tr > th {
		text-align: center;
		background-color: #ccc;
		border: 1px solid #ddd;
	}
	
	tfoot > tr > td {
		font-weight: bold;
		text-align: left;
		background-color: #ddd;
		border: 1px solid #ddd;
	}

</style>

<div class="ec-informe-semanal-total-ejecutivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <table id='tb'>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<p>
        <?php //echo Html::button('Excel', ['class' => 'btn btn-success', 'onclick' => 'exportar()' ]) ?>
    </p>

    <thead>
            <tr>
                <th rowspan='3' colspan='1'>EJE</th>
                <th rowspan='3' colspan='1'>Cnt. I.E.O sobre avance esperado</th>
                <th rowspan='3' colspan='1'>Cnt. De sedes sobre avance esperado</th>
                <th rowspan='3' colspan='1'>Porcentaje de I.E.O</th>
                <th rowspan='1' colspan='1'>Porcentaje sobre sedes</th>
                <th rowspan='1' colspan='1'>Porcentaje sobre actividad 1</th>
                <th rowspan='1' colspan='1'>Porcentaje sobre actividad 2</th>
                <th rowspan='1' colspan='1'>Porcentaje sobre actividad 3</th>
                <th rowspan='1' colspan='1'>Población Beneficiada Directamente</th>
                <th rowspan='1' colspan='1'>Población beneficiada de manera indirecta</th>
                <th rowspan='1' colspan='1'>Alarmas generales</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td rowspan='1' colspan='1'>PPT</td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]cantidad_ieo')->textInput([ 'value' => isset($cantidad_ieo[1]) ? $cantidad_ieo[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]cantidad_sedes')->textInput([ 'value' => isset($cantidad_sedes_ieo[1]) ? $cantidad_sedes_ieo[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]porcentaje_ieo')->textInput([ 'value' => isset($porcentaje_ieo[1]) ? $porcentaje_ieo[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]porcentaje_sedes')->textInput([ 'value' => isset($porcentaje_sedes[1]) ? $porcentaje_sedes[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]porcentaje_actividad_uno')->textInput([ 'value' => isset($porcentaje_actividad_uno[1]) ? $porcentaje_actividad_uno[1] : '']) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]porcentaje_actividad_dos')->textInput([ 'value' => isset($porcentaje_actividad_dos[1]) ? $porcentaje_actividad_dos[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]porcentaje_actividad_tres')->textInput([ 'value' => isset($porcentaje_actividad_tres[1]) ? $porcentaje_actividad_tres[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]poblacion_beneficiada_directa')->textInput([ 'value' => isset($poblacion_beneficiada_directa[1]) ? $poblacion_beneficiada_directa[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]poblacion_beneficiada_indirecta')->textInput([ 'value' => isset($poblacion_beneficiada_indirecta[1]) ? $poblacion_beneficiada_indirecta[1] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[0]alarmas_generales')->textInput([ 'value' => isset($alarmas_generales[1]) ? $alarmas_generales[1] : '']) ?></td>                
            </tr>

            <tr>
                <td rowspan='1' colspan='1'>PSSE</td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]cantidad_ieo')->textInput([ 'value' => isset($cantidad_ieo[2]) ? $cantidad_ieo[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]cantidad_sedes')->textInput([ 'value' => isset($cantidad_sedes_ieo[2]) ? $cantidad_sedes_ieo[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]porcentaje_ieo')->textInput([ 'value' => isset($porcentaje_ieo[2]) ? $porcentaje_ieo[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]porcentaje_sedes')->textInput([ 'value' => isset($porcentaje_sedes[2]) ? $porcentaje_sedes[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]porcentaje_actividad_uno')->textInput([ 'value' => isset($porcentaje_actividad_uno[2]) ? $porcentaje_actividad_uno[2] : '']) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]porcentaje_actividad_dos')->textInput([ 'value' => isset($porcentaje_actividad_dos[2]) ? $porcentaje_actividad_dos[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]porcentaje_actividad_tres')->textInput([ 'value' => isset($porcentaje_actividad_tres[2]) ? $porcentaje_actividad_tres[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]poblacion_beneficiada_directa')->textInput([ 'value' => isset($poblacion_beneficiada_directa[2]) ? $poblacion_beneficiada_directa[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]poblacion_beneficiada_indirecta')->textInput([ 'value' => isset($poblacion_beneficiada_indirecta[2]) ? $poblacion_beneficiada_indirecta[2] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[1]alarmas_generales')->textInput([ 'value' => isset($alarmas_generales[2]) ? $alarmas_generales[2] : '']) ?></td>               
            </tr>

            <tr>
                <td rowspan='1' colspan='1'>PAF</td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]cantidad_ieo')->textInput([ 'value' => isset($cantidad_ieo[3]) ? $cantidad_ieo[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]cantidad_sedes')->textInput([ 'value' => isset($cantidad_sedes_ieo[3]) ? $cantidad_sedes_ieo[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]porcentaje_ieo')->textInput([ 'value' => isset($porcentaje_ieo[3]) ? $porcentaje_ieo[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]porcentaje_sedes')->textInput([ 'value' => isset($porcentaje_sedes[3]) ? $porcentaje_sedes[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]porcentaje_actividad_uno')->textInput([ 'value' => isset($porcentaje_actividad_uno[3]) ? $porcentaje_actividad_uno[3] : '']) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]porcentaje_actividad_dos')->textInput([ 'value' => isset($porcentaje_actividad_dos[3]) ? $porcentaje_actividad_dos[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]porcentaje_actividad_tres')->textInput([ 'value' => isset($porcentaje_actividad_tres[3]) ? $porcentaje_actividad_tres[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]poblacion_beneficiada_directa')->textInput([ 'value' => isset($poblacion_beneficiada_directa[3]) ? $poblacion_beneficiada_directa[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]poblacion_beneficiada_indirecta')->textInput([ 'value' => isset($poblacion_beneficiada_indirecta[3]) ? $poblacion_beneficiada_indirecta[3] : '' ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[2]alarmas_generales')->textInput([ 'value' => isset($alarmas_generales[3]) ? $alarmas_generales[3] : '']) ?></td>                
            </tr>

           
            <tr>
                <td rowspan='1' colspan='1'>TOTAL</td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]cantidad_ieo')->textInput([ 'value' => isset($cantidad_ieo[1]) ? $cantidad_ieo[1] + $cantidad_ieo[2] +$cantidad_ieo[3] : '', 'readonly' => true]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]cantidad_sedes')->textInput([ 'value' => isset($cantidad_sedes_ieo[1]) ? $cantidad_sedes_ieo[1] + $cantidad_sedes_ieo[2]+ $cantidad_sedes_ieo[3] : '', 'readonly' => true]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]porcentaje_ieo')->textInput([ 'value' => isset($porcentaje_ieo[3]) ? ((($porcentaje_ieo[3]+ $porcentaje_ieo[2] + $porcentaje_ieo[1]) / 3) .'%') : '', 'readonly' => true ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]porcentaje_sedes')->textInput([ 'value' => isset($porcentaje_sedes[3]) ? ((($porcentaje_sedes[3]+ $porcentaje_sedes[2] + $porcentaje_sedes[1]) / 3) .'%') : '', 'readonly' => true ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]porcentaje_actividad_uno')->textInput([ 'value' => isset($porcentaje_actividad_uno[3]) ? ((($porcentaje_actividad_uno[3]+ $porcentaje_actividad_uno[2] + $porcentaje_actividad_uno[1]) / 3) .'%') : '', 'readonly' => true]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]porcentaje_actividad_dos')->textInput([ 'value' =>  isset($porcentaje_actividad_dos[3]) ? ((($porcentaje_actividad_dos[3]+ $porcentaje_actividad_dos[2] + $porcentaje_actividad_dos[1]) / 3) .'%') : '', 'readonly' => true]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]porcentaje_actividad_tres')->textInput([ 'value' =>  isset($porcentaje_actividad_tres[3]) ? ((($porcentaje_actividad_tres[3]+ $porcentaje_actividad_tres[2] + $porcentaje_actividad_tres[1]) / 3) .'%') : '', 'readonly' => true]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]poblacion_beneficiada_directa')->textInput([ 'value' => isset($poblacion_beneficiada_directa[1]) ? ($poblacion_beneficiada_directa[1] + $poblacion_beneficiada_directa[2] +$poblacion_beneficiada_directa[3]) : '', 'readonly' => true ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]poblacion_beneficiada_indirecta')->textInput([ 'value' => isset($poblacion_beneficiada_indirecta[1]) ? ($poblacion_beneficiada_indirecta[1] + $poblacion_beneficiada_indirecta[2] +$poblacion_beneficiada_indirecta[3]) : '', 'readonly' => true ]) ?></td>
                <td rowspan='1' colspan='1'><?= $form->field($model, '[4]alarmas_generales')->textInput([ 'value' => isset($alarmas_generales[1]) ? ($alarmas_generales[1] + $alarmas_generales[2] +$alarmas_generales[3]) : '', 'readonly' => true]) ?></td>                
            </tr>
        </tbody>


    </table>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
