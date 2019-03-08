<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\GcResultadosMomento1Buscar;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento1 */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerCssFile("@web/css/momentos.css");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/momentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

//se captura el valor de la semana
$id_bitacora= $_GET['id_bitacora'];
$id_semana= $_GET['id'];
$id_momento1= 1;
?>

<?= Html::a('Volver',['gc-bitacora/view2','id'=>$id_momento1],['class' => 'btn btn-info']) ?>
<div class="modal fade" id="modalSaveData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Guardado con exito
            </div>
        </div>
    </div>
</div>
<section class="form-box" >
    <div class="container">

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-1 form-wizard">

                <h3>Planeación de la semana</h3>
                <p>Debe terminar un paso para continuar con el siguiente</p>

                <!-- Form progress -->
                <div class="form-wizard-steps form-wizard-tolal-steps-2">
                    <div class="form-wizard-progress">
                        <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
                    </div>
                    <!-- Step 1 -->
                    <div class="form-wizard-step active">
                        <div class="form-wizard-step-icon"><i class="fa fa-address-book" aria-hidden="true"></i></div>
                        <p>Paso 1 Propositos de acompañamiento</p>
                    </div>
                    <!-- Step 1 -->

                    <!-- Step 2 -->
                    <div class="form-wizard-step">
                        <div class="form-wizard-step-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>
                        <p>Paso 2 Resultados esperados</p>
                    </div>
                    <!-- Step 2 -->

                    <!-- Step 3
                    <div class="form-wizard-step">
                        <div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                        <p>Official</p>
                    </div>
                    <!-- Step 3 -->

                    <!-- Step 4
                    <div class="form-wizard-step">
                        <div class="form-wizard-step-icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <p>Payment</p>
                    </div>
                    <!-- Step 4 -->
                </div>
                <!-- Form progress -->
                <!-- Form progress -->


                <!-- Form Step 1 -->
                <fieldset>
                    <?php $form = ActiveForm::begin(); ?>
                    <h4>Seleccione los propósitos que se trabajarán a través de las actividades planteadas para esta semana</h4>
                    <hr>
                    <label><h4>Propósitos de acompañamiento</h4></label>
                    <h6>
                        <?=Html::checkboxList('list', '', $propositos,['separator' => "<br />",'id' =>'checkboxMomento1Semana1',
                            'itemOptions' => [
                                'labelOptions' => [
                                    'style' => 'font-weight: normal',
                                    // 'class' => 'some-custom-class',
                                ],
                            ],
                        ]) ?>
                    </h6>
                    <hr>
                    <div id="contentDays">
                        <input type="hidden" value="<?php echo $_GET['id'] ?>" id="id"/>
                        <div class="form-group" id="addDay-1">
                            <label class="control-label" for="gcplaneacionpordia-id_dia-1">Día</label>
                            <select id="gcplaneacionpordia-id_dia-1" class="form-control required" name="GcPlaneacionPorDia[id_dia]" aria-required="true" disabled>
                                <option value="">Seleccione...</option>
                                <option value="1">Dia 1</option>
                                <option value="2">Dia 2</option>
                                <option value="3">Dia 3</option>
                                <option value="4">Dia 4</option>
                                <option value="5">Dia 5</option>
                                <option value="6">Dia 6</option>
                                <option value="7">Dia 7</option>
                            </select>
                            <label class="control-label" for="gcplaneacionpordia-descripcion_plan-1">Descripción Plan</label>
                            <textarea id="gcplaneacionpordia-descripcion_plan-1" class="form-control required" name="GcPlaneacionPorDia[descripcion_plan]" maxlength="300" rows="6" cols="50" aria-required="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button value="1" id="btnAddDay" type="button" class="btn btn-primary btn-sm">Agregar día</button>
                    </div>
                    <div class="form-group form-wizard-buttons">
                        <button id="saveMoment1" type="button" class="btn btn-next">Guardar y continuar</button>
                    </div>
                    <?php ActiveForm::end(); ?>
                </fieldset>
                <!-- Form Step 1 -->

                <!-- Form Step 2 -->
                <fieldset>
                    <div class="gc-resultados-momento1-form">

                        <h4>Describa los resultados que se esperan obtener de las actividades que se adelantarán en la semana.</h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label><h4>Registro de un nuevo resultado esperado</h4></label>

                                <?php $form1 = ActiveForm::begin(); ?>

                                <?= $form1->field($modelResultadosMomento1, 'nombre')->textInput(['maxlength' => true,'placeholder' => 'Nombre del resultado esperado'])->label('Nombre del resultado esperado') ?>

                                <?= $form1->field($modelResultadosMomento1, 'descripcion')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 ,'placeholder' => 'Descripción del resultado esperado'] )->label('Descripción del resultado esperado')?>

                                <?= $form1->field($modelResultadosMomento1, 'id_momento1')->hiddenInput(['value' => $id_momento1])->label(false) ?>

                                <?= $form1->field($modelResultadosMomento1, 'estado')->hiddenInput(['value'=> 1])->label(false) ?>

                                <div class="form-group">
                                    <button id="listPaso2" type="button" class="btn btn-success">Guardar</button>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <!-- data table-->
                            <div class="col-md-6">
                                <div class="gc-resultados-momento1-index">


                                    <?php $searchModel = new GcResultadosMomento1Buscar();
                                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                                    ?>

                                    <h4>Listado de resultados esperados registrados</h4>

                                    <?= DataTables::widget([
                                        'dataProvider' => $dataProvider,
                                        'clientOptions' => [
                                            'language'=>[
                                                'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
                                            ],
                                        ],
                                        'columns' => [
                                            'id',
                                            'nombre',
                                            // 'id_momento1',
                                            // 'estado',
                                            'descripcion'
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-wizard-buttons">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <?= Html::a('Finalizar',['gc-bitacora/view2','id'=>$id_momento1],['class' => 'btn btn-info', 'id'=>'finalizar_momneto1']) ?>
                    </div>
                </fieldset>
                <!-- Form Step 2 -->
                <!-- Form Wizard -->
            </div>
        </div>

    </div>
</section>
