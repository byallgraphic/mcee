<?php
/**********
---------------------------------------
Versión: 001
Fecha: 23-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Controlador de la vista que contiene los botones de competencias básicas proyectos pedagogicos transversales
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
class EcCompetenciasBasicasTransversalidadController extends Controller
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
     * LLama a la vista de botones de competencas básicas proyectos pedagogicos transversales
     * @return mixed
     */
	 
    public function actionIndex()
    {
		
	
			return $this->render('index', [
				
			]);
		
    }

    
}
