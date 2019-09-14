<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GcBitacora */

$this->title = "Visualización de la bitácora";
$this->params['breadcrumbs'][] = ['label' => 'Bitacora', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

?>

<?= Html::a('Volver',['gc-bitacora/index',],['class' => 'btn btn-info']) ?>

<div class="gc-bitacora-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12 ui-sortable">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Información del docente tutor</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    <tr>
                                        <th class="ancho-30-pct"></th>
                                        <th></th>
                                        <th th="" class="ancho-30-pct"></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="field">Docente:</td>
                                        <td>GRAPHIC MEDELLIN</td>
                                        <td class="field">Jornada:</td>
                                        <td>Mañana</td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width: 250px">Profesional de acompañamiento a cargo del docente:</td>
                                        <td>ACOMPAÑAMIENTO BY ALL GRAPHIC</td>
                                        <td class="field">Sede de la bitacora:</td>
                                        <td>IEO AGUSTIN NIETO CABALLERO -- AGUSTIN NIETO CABALLERO</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ui-sortable">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Visualización de la bitácora</h4>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="text-center">Avance en los propósitos seleccionados</h4>
                        </div>

                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>Propósito</th>
                                        <!--<th>Nivel de avance</th>-->
                                        <th>Justificación</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <hr style="border-top-color: #000000">
                        </div>

                        <div class="col-sm-12">
                            <ul class="nav nav-tabs hidden-print">

                                <li class="active "><a href="#tab-semana-1" data-toggle="tab">Semana 1</a></li>

                                <li class=" "><a href="#tab-semana-2" data-toggle="tab">Semana 2</a></li>

                                <li class=" "><a href="#tab-semana-3" data-toggle="tab">Semana 3</a></li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade active in" id="tab-semana-1">
                                    <h2 class="text-center">Semana 1</h2>
                                    <br>
                                    <h4 class="text-center">Propósitos seleccionados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción del propósito</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>
                                                            2. Identificar y promover prácticas pedagógicas en términos de experiencias, innovación e investigación pedagógica.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            3. Identificar y orientar el desarrollo y la divulgación de recursos pedagógicos y didácticos que permitan el mejoramiento de las prácticas escolares.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            5. Realizar ejercicios de escritura (individuales o colectivos) en relación con las prácticas pedagógicas identificadas en la Institución Educativa.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            7. Gestionar los espacios, recursos y demás variables requeridas en el acompañamiento de la institución hacia nuevas y mejores prácticas pedagógicas.
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Planeación por día</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Descripción plan</th>
                                                        <th>Dia</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

									
									<hr>

                                    <h4 class="text-center">Resultados esperados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Nombre del resultado</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Evidencias de visitas</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción visitas</th>
                                                        <th>Dia</th>
                                                        <th class="ancho-30-pct">¿Se realizó visita?</th>
                                                        <th>Evidencia / Justificación</th>
                                                        <th># estudiantes</th>
                                                        <th># docentes</th>
                                                        <th># directivos</th>
                                                        <th># Otros</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                   </div>

                                <div class="tab-pane fade" id="tab-semana-2">
                                    <h2 class="text-center">Semana 2</h2>
                                    <br>
                                    <h4 class="text-center">Propósitos seleccionados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción del propósito</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>
                                                            2. Identificar y promover prácticas pedagógicas en términos de experiencias, innovación e investigación pedagógica.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            3. Identificar y orientar el desarrollo y la divulgación de recursos pedagógicos y didácticos que permitan el mejoramiento de las prácticas escolares.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            5. Realizar ejercicios de escritura (individuales o colectivos) en relación con las prácticas pedagógicas identificadas en la Institución Educativa.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            7. Gestionar los espacios, recursos y demás variables requeridas en el acompañamiento de la institución hacia nuevas y mejores prácticas pedagógicas.
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Planeación por día</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Descripción plan</th>
                                                        <th>Dia</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

									
									<hr>

                                    <h4 class="text-center">Resultados esperados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Nombre del resultado</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Evidencias de visitas</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción visitas</th>
                                                        <th>Dia</th>
                                                        <th class="ancho-30-pct">¿Se realizó visita?</th>
                                                        <th>Evidencia / Justificación</th>
                                                        <th># estudiantes</th>
                                                        <th># docentes</th>
                                                        <th># directivos</th>
                                                        <th># Otros</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    </div> 

                                
                                 <div class="tab-pane fade" id="tab-semana-3">
                                    <h2 class="text-center">Semana 3</h2>
                                    <br>
                                    <h4 class="text-center">Propósitos seleccionados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción del propósito</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>
                                                            2. Identificar y promover prácticas pedagógicas en términos de experiencias, innovación e investigación pedagógica.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            3. Identificar y orientar el desarrollo y la divulgación de recursos pedagógicos y didácticos que permitan el mejoramiento de las prácticas escolares.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            5. Realizar ejercicios de escritura (individuales o colectivos) en relación con las prácticas pedagógicas identificadas en la Institución Educativa.
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            7. Gestionar los espacios, recursos y demás variables requeridas en el acompañamiento de la institución hacia nuevas y mejores prácticas pedagógicas.
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Planeación por día</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Descripción plan</th>
                                                        <th>Dia</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

									
									<hr>

                                    <h4 class="text-center">Resultados esperados</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="ancho-50-pct">Nombre del resultado</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td>sfasdfs</td>
                                                        <td>asdfsadf</td>
                                                    </tr>

                                                    <tr>
                                                        <td>asfbgdsf</td>
                                                        <td>asdfasdfesdfasdf</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="text-center">Evidencias de visitas</h4>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>Descripción visitas</th>
                                                        <th>Dia</th>
                                                        <th class="ancho-30-pct">¿Se realizó visita?</th>
                                                        <th>Evidencia / Justificación</th>
                                                        <th># estudiantes</th>
                                                        <th># docentes</th>
                                                        <th># directivos</th>
                                                        <th># Otros</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

								</div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
