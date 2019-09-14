<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ejecucion_fase_i_estudiantes".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $id_datos_ieo_profesional_estudiantes
 * @property string $id_datos_sesion
 * @property string $estado
 * @property string $participacion_sesiones
 * @property string $numero_estudiantes
 * @property string $apps_creadas
 * @property string $aplicaciones_creadas
 * @property string $sesiones_empleadas
 * @property string $acciones_realizadas
 * @property string $estudiantes_id
 * @property string $problemas_creacion
 * @property string $competencias_inferidas
 * @property string $observaciones
 * @property string $id_ciclo
 */
class SemillerosTicEjecucionFaseIEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ejecucion_fase_i_estudiantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion'], 'required'],
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion', 'estado'], 'default', 'value' => null],
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion', 'estado', 'numero_estudiantes', 'apps_creadas', 'sesiones_empleadas','participacion_sesiones'], 'integer'],
            [['aplicaciones_creadas', 'acciones_realizadas', 'problemas_creacion', 'competencias_inferidas', 'observaciones'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            // [['id_ciclo'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicCiclos::className(), 'targetAttribute' => ['id_ciclo' => 'id']],
            [['id_datos_ieo_profesional_estudiantes'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosIeoProfesionalEstudiantes::className(), 'targetAttribute' => ['id_datos_ieo_profesional_estudiantes' => 'id']],
            [['id_datos_sesion'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosSesiones::className(), 'targetAttribute' => ['id_datos_sesion' => 'id']],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicFases::className(), 'targetAttribute' => ['id_fase' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_fase' => 'Id Fase',
            'id_datos_ieo_profesional_estudiantes' => 'Id Datos Ieo Profesional Estudiantes',
            'id_datos_sesion' => 'Id Datos Sesion',
            'estado' => 'Estado',
            'participacion_sesiones' => 'Participacion Sesiones',
            'numero_estudiantes' => 'Numero Estudiantes',
            'apps_creadas' => 'Apps Creadas',
            'aplicaciones_creadas' => 'Aplicaciones Creadas',
            'sesiones_empleadas' => 'Sesiones Empleadas',
            'acciones_realizadas' => 'Acciones Realizadas',
            'problemas_creacion' => 'Problemas Creacion',
            'competencias_inferidas' => 'Competencias Inferidas',
            'observaciones' => 'Observaciones',
            'id_ciclo' => 'Id Ciclo',
            'anio' => 'Año',
            'estudiantes_id' => 'Estudiantes Id',
        ];
    }
}
