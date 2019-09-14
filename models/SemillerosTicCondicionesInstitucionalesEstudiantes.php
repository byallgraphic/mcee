<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.condiciones_institucionales_estudiantes".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $id_ciclo
 * @property string $id_datos_ieo_profesional_estudiantes
 * @property string $estado
 * @property string $parte_ieo
 * @property string $parte_univalle
 * @property string $parte_sem
 * @property string $otro
 * @property string $participantes_por_curso
 * @property string $promedio_estudiantes_por_curso
 * @property string $total_sesiones
 * @property string $total_estudiantes
 */
class SemillerosTicCondicionesInstitucionalesEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.condiciones_institucionales_estudiantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'id_ciclo', 'id_datos_ieo_profesional_estudiantes', 'estado', 'parte_ieo', 'parte_univalle', 'parte_sem', 'otro', 'participantes_por_curso', 'promedio_estudiantes_por_curso', 'total_sesiones', 'total_estudiantes'], 'required'],
            [['id_fase', 'id_ciclo', 'id_datos_ieo_profesional_estudiantes', 'estado'], 'default', 'value' => null],
            [['id_fase', 'id_ciclo', 'id_datos_ieo_profesional_estudiantes', 'estado', 'participantes_por_curso', 'promedio_estudiantes_por_curso', 'total_sesiones', 'total_estudiantes' ], 'integer'],
            [['parte_ieo', 'parte_univalle', 'parte_sem', 'otro'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_ciclo'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicCiclos::className(), 'targetAttribute' => ['id_ciclo' => 'id']],
            [['id_datos_ieo_profesional_estudiantes'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosIeoProfesionalEstudiantes::className(), 'targetAttribute' => ['id_datos_ieo_profesional_estudiantes' => 'id']],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicFases::className(), 'targetAttribute' => ['id_fase' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 									=> 'ID',
            'id_fase' 								=> 'Id Fase',
            'id_ciclo' 								=> 'Id Ciclo',
            'id_datos_ieo_profesional_estudiantes' 	=> 'Id Datos Ieo Profesional Estudiantes',
            'estado' 								=> 'Estado',
            'parte_ieo' 							=> 'Por parte de la IEO',
            'parte_univalle' 						=> 'Por parte de UNIVALLE',
            'parte_sem' 							=> 'Por parte de la SEM',
            'otro' 									=> 'Otro',
            'participantes_por_curso' 				=> 'Número de Sesiones participantes por curso',
            'promedio_estudiantes_por_curso' 		=> 'Número de estudiantes participantes por curso (Promedio)',
            'total_sesiones' 						=> 'Total sesiones por IEO',
            'total_estudiantes' 					=> 'Total estudiantes IEO (Promedio)',
        ];
    }
}
