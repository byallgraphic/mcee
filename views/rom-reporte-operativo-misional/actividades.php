<?php


use app\models\IsaRomActividades;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;

use yii\helpers\Html;
// $model = new IsaRomActividades();

$this->registerJs("
	$( document ).on('click', 'li', function() { 
		var cont = $( this ).attr('href');
		$( '[id^=content][id!='+cont.substr(1)+']', $(this).parent().parent() ).css({display:'none'}); 
		$( $( this ).attr('href'), $(this).parent().parent() ).toggle();  
		console.log( $( '[id^=content]', $(this).parent().parent() ) )
	});
");

$actividades= IsaRomActividades::find()->where( "estado=1 and id_rom_procesos=$idProceso" )->all();
$actividades = ArrayHelper::map($actividades,'id','descripcion');
       
	foreach( $actividades as $idActividad => $v )
	{
		$labels[] = $v;
		$items[] = 	[
						'label' 		=>  $v,
						'content' 		=>  $this->render( 'formulario', 
														[ 
															'idActividad' => $idActividad,
															'form' => $form,
															'idProyecto' => $idProyecto,
															'datos'=>$datos,
															'estados'=>$estados,
														] 
											),
						'contentOptions'=> []
					];	
		
		
	}
	
	// foreach( $labels as $key => $item ){
		
		echo Html::ul( $labels, ['item' => function($item, $index) {
						return Html::tag(
							'li',
							$item,
							['class' => 'post' , 'href' => '#content-'.$index, 'name' => 'actividad-'.$index ]
						);
					},
					'class' => 'tabs',
					] 
				);
	// }
	
	foreach( $items as $key => $item ){
		
		echo Html::tag( 'div', $item['content'], [ 'style' => 'display:none', 'id' => 'content-'.$key ] );
	}
				


// echo Collapse::widget([
    // 'items' => $items, 
// ]);