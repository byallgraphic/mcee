<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use fedemotta\datatables\DataTables;
use app\models\GcMomento2Buscar;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento2 */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerCssFile("@web/css/momentos.css");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/momento2.js',['depends' => [\yii\web\JqueryAsset::className()]]);

//se captura el valor de la semana
$id_bitacora= $_GET['id_bitacora'];
$id_semana= $_GET['id'];
$id_momento1= 2;


?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="gc-momento2-form">

    <?php $form = ActiveForm::begin(); ?>
	
				<fieldset>
						<h4>Registre las evidencias desarrolladas durante cada día.</h4>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<label><h4>Formulario de una visita</h4></label>								

								<?= $form->field($model, 'id_semana')->hiddenInput(['value' => $id_semana])->label(false) ?>

								<?= $form->field($model, 'realizo_visita')->checkbox() ?>

                                <div id="content_visita">
                                    <?= $form->field($model, 'descripcion_visita')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 ,'placeholder' => 'Descripción de las visitas'] )->label('Descripción de las visitas')?>


                                    <div class="col-md-8">
                                        <label><h5>Atenciones realizadas</h5></label>
                                    </div>

                                    <div class="col-xs-6"><?= $form->field($model, 'estudiantes')->textInput(['type' => 'number','value'=> 0]) ?></div>

                                    <div class="col-xs-6"><?= $form->field($model, 'docentes')->textInput(['type' => 'number','value'=> 0]) ?></div>

                                    <div class="col-xs-6"><?= $form->field($model, 'directivos')->textInput(['type' => 'number','value'=> 0]) ?></div>

                                    <div class="col-xs-6"><?= $form->field($model, 'otro')->textInput(['type' => 'number','value'=> 0]) ?></div>

                                    <div class="col-md-8">
                                        <label><h5>Evidencia del acompañamiento ( .jpg, .jpeg o .png ).</h5></label>
                                    </div>

                                    <input id="id_semana" type="hidden" value="<?= $id_semana ?>">

                                    <div class="col-md-8" id="dias_file">
                                        <?php foreach ($planeacionDias AS $dias){?>
                                            Dia <?= $dias['id_dia'] ?>
                                            <input type="file" class="file-dia">
                                            <br>
                                        <?php } ?>
                                    </div>
                                </div>

								<div class="col-md-8"><?= $form->field($model, 'justificacion_no_visita')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 ,'placeholder' => 'Justificación no visita'] )->label('Justificación no visita')?></div>

								<?= $form->field($model, "estado")->hiddenInput(['value'=> 1])->label(false) ?>

								
							</div>
							
							<!-- Data table-->
							
							<div class="gc-momento2-index">

   
									<?php  $searchModel = new GcMomento2Buscar();
										   $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
									?>
									<div class="col-md-8">
									
									<div class="alert alert-warning text-center" role="alert">
										<h4 class="alert-heading">Tener en cuenta</h4>
										<p>Al finalizar la semana, debe entregar en físico, las asistencias correspondientes a las <b>visitas</b> realizadas
									durante la semana, a su profesional de acompañamiento.</p>
									</div>
									<h4>Listado de visitas registradas</h4>

										<?= DataTables::widget([
											'dataProvider' => $dataProvider,
											'clientOptions' => [
											'language'=>[
													'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
												],
											"lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
											"info"=>false,
											"responsive"=>true,
											 "dom"=> 'lfTrtip',
											 "tableTools"=>[
												 "aButtons"=> [  
														// [
														// "sExtends"=> "copy",
														// "sButtonText"=> Yii::t('app',"Copiar")
														// ],
														// [
														// "sExtends"=> "csv",
														// "sButtonText"=> Yii::t('app',"CSV")
														// ],
														[
														"sExtends"=> "xls",
														"oSelectorOpts"=> ["page"=> 'current']
														],
														[
														"sExtends"=> "pdf",
														"oSelectorOpts"=> ["page"=> 'current']
														],
														// [
														// "sExtends"=> "print",
														// "sButtonText"=> Yii::t('app',"Imprimir")
														// ],
													],
												],
										],
											   'columns' => [
												['class' => 'yii\grid\SerialColumn'],

												// 'id',
												// 'id_semana',
                                                'descripcion_visita',
												'estudiantes',
                                                [
                                                   'class' => 'yii\grid\ActionColumn',
                                                   'template'=>'{myButton}',
                                                    'header' => 'Justificación / Fotografía',
                                                   'buttons' => [
                                                       'myButton' => function ($url, $model) {
                                                           $t = 'index.php?r=site/update&id='.$model->id;
                                                           return Html::button('Visualizar evidencia', ['class'=>"btn btn-primary", 'data-target'=>"#exampleModal", 'data-toggle'=>"modal"]);
                                                       },

                                                   ],

                                                ],
												'docentes',
												'directivos',
												'otro',
												//'estado',

												[
												'class' => 'yii\grid\ActionColumn',
												'template'=>'{view}{update}{delete}',
													'buttons' => [
													'view' => function ($url, $model) {
														return Html::a('<span name="detalle" class="glyphicon glyphicon-eye-open" value ="'.$url.'" ></span>', $url, [
																	'title' => Yii::t('app', 'lead-view'),
														]);
													},

													'update' => function ($url, $model) {
														return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.$url.'"></span>', $url, [
																	'title' => Yii::t('app', 'lead-update'),
														]);
													}

												  ],
												
												],

											],
										]); ?>
									</div>

									<!-- Fin Data table-->
							</div>		
						</div>
						
						<div class="row">
						  <div class="col-xs-6 col-md-4">

                              <div class="form-group">
                                  <button id="listPaso2" type="button" class="btn btn-success">Guardar</button>
                              </div>
								<!--<div class="form-group form-wizard-buttons">
										<?/*= Html::submitButton('Guardar visita', ['class' => 'btn btn-success']) */?>
								</div>-->
						  </div>
						  <div class="col-xs-6 col-md-4"></div>
						  <div class="col-xs-6 col-md-4"></div>
						</div>
				</fieldset>

									<?php ActiveForm::end(); ?>

</div>
