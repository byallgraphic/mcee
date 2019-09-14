<?php


use app\models\IsaLogrosActividades;
use app\models\IsaOrientacionMetodologicaActividades;
use app\models\IsaVariacionesActividades;
use app\models\IsaRomActividades;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];




$actividadesSeguimiento = IsaRomActividades::find()->where( "estado=1 and id_rom_procesos=$idProceso" )->all();
$actividadesSeguimiento = ArrayHelper::map($actividadesSeguimiento,'id','descripcion');

	

$content = '';       
foreach ($actividadesSeguimiento as $idActividad => $dataActividad)
{
		$content = Html::tag( 
						'div',  
						$this->render( 'porcentajes', 
										[ 
											'idActividad' => $idActividad,
											'form' => $form,
											'datos' => $datos,
											'idProyecto' => $idProyecto,
										] 
									),
						[ 'class' => 'list-group-item' ]
					);
					
		$content .= Html::tag( 
						'div',  
						$this->render( 'logros', 
									[ 
										'idActividad' => $idActividad,
										'form' => $form,
										'datos' => $datos,
										'idProyecto' => $idProyecto,
									] 
								),
						[ 'class' => 'list-group-item' ]
					);
					
	
	
		$items[] = 	[
						'label' 		=>  $dataActividad,
						'content' 		=>	$content,
						'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$idActividad];"],			
						'contentOptions'=> [],
						'active'		=> false,
					];

		
		
}
	
echo Tabs::widget([
    'items' => $items,
]);

$this->registerCss("

			.nav-tabs > li {
						
						width: 380px;
						height: 100px;
					}
					
					#w3 li:first-child:hover
						{
						 height: 150px;
						}
					#w6 li:first-child:hover
						{
						 height: 150px;
						}
					#w9 li:first-child:hover
						{
						 height: 150px;
						}
					#w13 li:first-child:hover
						{
						 height: 150px;
						}	
					.row {
						margin-left: 2px;
					}");

