<?php

/**
Modificaciones:
Por: Edwin Molina Grisales
Fecha: 2019-02-12
Descripción: Se agrega atributo anio
---------------------------------------
*/

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ejecucion_fase_iii".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $id_datos_ieo_profesional
 * @property string $estado
 * @property string $docente_creador
 * @property string $asignatura
 * @property string $docente_usuario
 * @property string $grado
 * @property string $numero_estudiantes
 * @property string $numero_apps_usadas
 * @property string $nombre_aplicaciones
 * @property string $tic
 * @property string $tipo_recurso_tic
 * @property string $digitales
 * @property string $tipo_recurso_digital
 * @property string $escolares_no_tic
 * @property string $tipo_recurso_no_tic
 * @property string $tiempo_uso_recurso_tic
 * @property string $observaciones
 * @property string $total_aplicaciones_usadas
 * @property string $numero
 * @property string $tipo_de_produccion
 * @property string $temas_escolares
 * @property string $indice_problematicas
 * @property string $fecha_uso_aplicaciones
 */
class SemillerosTicEjecucionFaseIii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ejecucion_fase_iii';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'id_datos_ieo_profesional', 'estado','docente_creador'], 'required'],
            [['id_fase', 'id_datos_ieo_profesional', 'estado'], 'default', 'value' => null],
            [['total_aplicaciones_usadas'], 'default', 'value' => ''],
            [['id_fase', 'id_datos_ieo_profesional', 'estado','anio'], 'integer'],
            [['asignatura', 'docente_usuario', 'grado', 'numero_apps_usadas', 'nombre_aplicaciones', 'tic', 'tipo_recurso_tic', 'digitales', 'tipo_recurso_digital', 'escolares_no_tic', 'tipo_recurso_no_tic', 'tiempo_uso_recurso_tic', 'observaciones', 'total_aplicaciones_usadas', 'numero', 'tipo_de_produccion', 'temas_escolares', 'indice_problematicas', 'fecha_uso_aplicaciones','estudiantes_cultivadores','tipo_conpetencias'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_datos_ieo_profesional'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosIeoProfesional::className(), 'targetAttribute' => ['id_datos_ieo_profesional' => 'id']],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicFases::className(), 'targetAttribute' => ['id_fase' => 'id']],
            [['id_datos_sesion'], 'exist', 'skipOnError' => true, 'targetClass' => DatosSesiones::className(), 'targetAttribute' => ['id_datos_sesion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 						=> 'ID',
            'id_fase' 					=> 'Id Fase',
            'id_datos_ieo_profesional' 	=> 'Id Datos Ieo Profesional',
            'estado' 					=> 'Estado',
            'docente_creador' 			=> 'Docente Creador',
            'asignatura' 				=> 'Asignatura',
            'docente_usuario' 			=> 'Docente Usuario',
            'grado' 					=> 'Grado',
            'numero_apps_usadas' 		=> 'Numero Apps Usadas',
            'nombre_aplicaciones' 		=> 'Nombre Aplicaciones',
            'tic' 						=> 'Tic',
            'tipo_recurso_tic' 			=> 'Tipo Recurso Tic',
            'digitales' 				=> 'Digitales',
            'tipo_recurso_digital' 		=> 'Tipo Recurso Digital',
            'escolares_no_tic' 			=> 'Escolares No Tic',
            'tipo_recurso_no_tic' 		=> 'Tipo Recurso No Tic',
            'tiempo_uso_recurso_tic' 	=> 'Tiempo Uso Recurso Tic',
            'observaciones' 			=> 'Observaciones',
            'total_aplicaciones_usadas' => 'Total Aplicaciones Usadas',
            'numero' 					=> 'Numero',
            'tipo_de_produccion' 		=> 'Tipo De Produccion',
            'temas_escolares' 			=> 'Temas Escolares',
            'indice_problematicas' 		=> 'Indice Problematicas',
            'fecha_uso_aplicaciones' 	=> 'Fecha Uso Aplicaciones',
            'estudiantes_cultivadores' 	=> 'Estudiantes cultivadores',
            'id_datos_sesion' 			=> 'Datos sesion',
            'anio' 						=> 'Año',
            'tipo_conpetencias'			=> 'Tipo de competencias inferidas y comprometidas en el proceso de creación de la app 0.0',
        ];
    }
}
