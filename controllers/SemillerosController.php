<?php
/**********
---------------------------------------
Versión: 001
Fecha: 18-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Controlador de la vista que contiene los botones de semilleros tic
---------------------------------------

**********/
namespace app\controllers;

if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	header('Location: index.php?r=site%2Flogin');
	die;
}

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Estudiantes;
use yii\data\SqlDataProvider;


use app\models\Asignaturas;
use app\models\AsginaturasBuscar;
use app\models\Estados;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\Paralelos;
use app\models\SedesJornadas;
use app\models\SemillerosDatosIeo;
use app\models\Personas;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;




/**
 * AsignaturasController implements the CRUD actions for Asignaturas model.
 */
class SemillerosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	
	
	
	


    /**
     * Lists all Asignaturas models.
     * @return mixed
     */
	 //recibe 2 parametros con la intencion de filtrar por institucion y por sede
    // public function actionIndex($idInstitucion = 0, $idSedes = 0)
    public function actionIndex()
    {
		
	
			return $this->render('index', [
				
			]);
		
    }

    
}
