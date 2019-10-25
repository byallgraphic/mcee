<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**********
---------------------------------------
Modificaciones:
Fecha: 09-01-2019
Persona encargada: Edwin Molina - Johan Ospina
Cambios realizados: Se mejora script para pedir la institución y la sede. Los script correspondientes js están todo incluidos en header.js.
---------------------------------------
**********/

if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}	

use app\models\Instituciones;

//con que id institucion y que id sede se debe trabajar 
if (@$_GET['instituciones'])
{
	$idInstitucion = $_GET['instituciones'];
	$_SESSION['institucionSeleccionada'][0]=$idInstitucion;
	
	//Busco la posicion en el array de la insitucion
	$clave = array_search( $idInstitucion, $_SESSION['instituciones'] );
	
	//Elimino la institución del array
	array_splice( $_SESSION['instituciones'], $clave, 1 );
	
	//Agrego la institución en la primera posición
	array_unshift( $_SESSION['instituciones'], $idInstitucion );
	
	// $_SESSION['instituciones'][0]=$idInstitucion;
	?>
	<script>  document.cookie = 'institucionJs=" <?php echo $idInstitucion; ?>"'; </script>
	
	<?php
	
	$nombreInstitucion = Instituciones::find()->where(['id' => @$_SESSION['institucionSeleccionada']])->one();
	$nombreInstitucion = @$nombreInstitucion->descripcion;
	$_SESSION['sede'][0]=-1;
    die("$nombreInstitucion - <label id='nameSede'>SEDE NO ASIGNADA</label>");
}
if (@$_GET['sede'])
{
	$_SESSION['sede'][0]=$_GET['sede'];
}


 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/sweetalert2.js',['depends' => [\yii\web\JqueryAsset::className()]]);
 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
 	
	//solo los id de institucion a los que la persona con ese perfil pertenece
 foreach($_SESSION['instituciones'] as $i)
		{
			$idInstituciones[]=$i;
		}
		
		$idInstituciones= implode(",",$idInstituciones);

	
	
$connection = Yii::$app->getDb();
//saber el id de la sede para redicionar al index correctamente
$command = $connection->createCommand("
SELECT id, descripcion
FROM instituciones 
WHERE estado = 1
AND id in($idInstituciones)
");
$result = $command->queryAll();

$datos =[];
foreach($result as $r)
{
	$id=$r['id'];
	$descripcion = $r['descripcion'];
	// $datos.= "'$id':'$descripcion'";
	$datos[$id] = $descripcion;
}

$this->registerJs( "datosInstitucion = ".json_encode($datos).";" );



if (!isset($_SESSION['institucionSeleccionada']) || (isset($_GET['institucion']) && $_GET['institucion'])){
	
	$this->registerJs( "datosInstitucion = ".json_encode( $datos ).";" );
	$this->registerJs( "$( cambiarInstitucion ).click();" );
   
}

if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

/* @var $this yii\web\View */

$this->title = 'Sistema de Información MCEE';
?>

<div class="site-index">

    <div class="jumbotron">
        <h2>Bienvenido al sistema de información MI COMUNIDAD ES ESCUELA</h2>
        <img src="../views/site/logo_mcee.png" style="width: 100%; margin: 15px auto;">
	</div>
</div>