<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\Instituciones;
use app\models\Sedes;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div>
<style>
	.modalemg{
		width:80%;
	}

	#modalArchivosContent {
	  overflow-y:auto;
	}


	.title-file{
		background-color: #ccc;padding:5px;
	}
</style>

<?php foreach( $datos as $dato ) : ?>
	
	<div class='col-md-6'>
		
		<div class='col-md-12'>
			<h3 class='title-file'><?= $dato['title'] ?></h3>
		</div>
		
		<?php foreach( $dato['archivos'] as $archivo ) : ?>
		
			<div class='row'>
			
				<div class='col-md-1 text-center'>
					<span style='color:red;' class='glyphicon glyphicon-remove' onclick="removeFile( this, '<?= $id ?>', '<?= $dato['campo'] ?>', '<?= $archivo['archivo'] ?>')"></span>
				</div>
				
				<div class='col-md-11'>
					<?= Html::a( $archivo['descripcion'], $archivo['archivo'], [ 'class' => '' ] ) ?>
				</div>
			
			</div>
			
		<?php endforeach; ?>
		
	</div>
	
<?php endforeach; ?>
</div>

