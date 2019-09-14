<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ejecucion_fase_iii_estudiantes".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $id_ciclo
 * @property string $id_datos_ieo_profesional_estudiantes
 * @property string $id_datos_sesion
 * @property string $estado
 * @property int $estudiantes_participantes
 * @property int $numero_apps
 * @property string $nombre_aplicaciones
 * @property string $tic
 * @property string $tipo_uso_tic
 * @property string $digitales
 * @property string $tipos_uso_digitales
 * @property string $no_tic
 * @property string $tipo_uso_no_tic
 * @property string $tiempo_uso_recursos
 * @property int $numero_obras
 * @property string $tipo_produccion
 * @property string $temas_abordados
 * @property string $problemas_abordados
 * @property string $fecha_aplicaciones
 * @property int $numero_asignaturas
 * @property string $asignaturas
 * @property string $observaciones
 * @property string $estudiantes_id
 *
 */
class SemillerosTicEjecucionFaseIiiEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ejecucion_fase_iii_estudiantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'anio', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion', 'estado', 'estudiantes_participantes', 'numero_apps', 'nombre_aplicaciones', 'tic', 'tipo_uso_tic', 'digitales', 'tipos_uso_digitales', 'no_tic', 'tipo_uso_no_tic', 'tiempo_uso_recursos', 'numero_obras', 'tipo_produccion', 'temas_abordados', 'problemas_abordados', 'fecha_aplicaciones', 'numero_asignaturas', 'asignaturas', 'observaciones'], 'required'],
            [['id_fase', 'anio', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion', 'estado', 'estudiantes_participantes', 'numero_apps', 'numero_obras', 'numero_asignaturas'], 'default', 'value' => null],
            [['id_fase', 'anio', 'id_datos_ieo_profesional_estudiantes', 'id_datos_sesion', 'estado', 'estudiantes_participantes', 'numero_apps', 'numero_obras', 'numero_asignaturas'], 'integer'],
            [['nombre_aplicaciones', 'tic', 'tipo_uso_tic', 'digitales', 'tipos_uso_digitales', 'no_tic', 'tipo_uso_no_tic', 'tiempo_uso_recursos', 'tipo_produccion', 'temas_abordados', 'problemas_abordados', 'fecha_aplicaciones', 'asignaturas', 'observaciones'], 'string'],
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
            // 'id_ciclo' => 'Id Ciclo',
            'anio' => 'Año',
            'id_datos_ieo_profesional_estudiantes' => 'Id Datos Ieo Profesional Estudiantes',
            'id_datos_sesion' => 'Id Datos Sesion',
            'estado' => 'Estado',
            'estudiantes_participantes' => 'Estudiantes Participantes',
            'numero_apps' => 'Numero Apps',
            'nombre_aplicaciones' => 'Nombre Aplicaciones',
            'tic' => 'Tic',
            'tipo_uso_tic' => 'Tipo Uso Tic',
            'digitales' => 'Digitales',
            'tipos_uso_digitales' => 'Tipos Uso Digitales',
            'no_tic' => 'No Tic',
            'tipo_uso_no_tic' => 'Tipo Uso No Tic',
            'tiempo_uso_recursos' => 'Tiempo Uso Recursos',
            'numero_obras' => 'Numero Obras',
            'tipo_produccion' => 'Tipo Produccion',
            'temas_abordados' => 'Temas Abordados',
            'problemas_abordados' => 'Problemas Abordados',
            'fecha_aplicaciones' => 'Fecha Aplicaciones',
            'numero_asignaturas' => 'Numero Asignaturas',
            'asignaturas' => 'Asignaturas',
            'observaciones' => 'Observaciones',
        ];
    }
}
