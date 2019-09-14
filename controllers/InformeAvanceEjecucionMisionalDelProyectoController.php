<?php
namespace app\controllers; 

use Yii;
use yii\web\Controller;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;

//Controlador
class InformeAvanceEjecucionMisionalDelProyectoController extends Controller
{
    // Index
    public function actionIndex()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
			
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
			
		$personas = Personas::find()
								->all();
		//Renderizando vista index	
		return $this->render('index',[
			'sede' 			=> $sede,
			'institucion' 	=> $institucion,
			'personas' 		=> $personas,
		]);
    }
}
