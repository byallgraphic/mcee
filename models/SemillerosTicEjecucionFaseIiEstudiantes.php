<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ejecucion_fase_ii_estudiantes".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $id_datos_ieo_profesional_estudiantes
 * @property string $id_ciclo
 * @property string $estado
 * @property int $estudiantes_participantes
 * @property int $apps_desarrolladas
 * @property string $nombre_aplicaciones
 * @property string $tipo_accion
 * @property string $descripcion
 * @property string $responsable_accion
 * @property string $tiempo_desarrollo
 * @property string $tic
 * @property string $tipo_uso_tic
 * @property string $digitales
 * @property string $tipo_uso_digitales
 * @property string $no_tic
 * @property string $tipo_uso_no_tic
 * @property string $tiempo_uso_tic
 * @property string $numero_obras
 * @property string $tipo_obras
 * @property string $indice_temas
 * @property int $numero_pruebas
 * @property int $numero_disecciones
 * @property string $observaciones
 * @property string $id_datos_sesion
 * @property string $estudiantes_id
 */
class SemillerosTicEjecucionFaseIiEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ejecucion_fase_ii_estudiantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'anio', 'estado', 'estudiantes_participantes', 'apps_desarrolladas', 'nombre_aplicaciones', 'tipo_accion', 'descripcion', 'responsable_accion', 'tiempo_desarrollo', 'tic', 'tipo_uso_tic', 'digitales', 'tipo_uso_digitales', 'no_tic', 'tipo_uso_no_tic', 'tiempo_uso_tic', 'numero_obras', 'tipo_obras', 'indice_temas', 'numero_pruebas', 'numero_disecciones', 'observaciones', 'id_datos_sesion'], 'required'],
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'anio', 'estado', 'estudiantes_participantes', 'apps_desarrolladas', 'numero_pruebas', 'numero_disecciones', 'id_datos_sesion'], 'default', 'value' => null],
            [['id_fase', 'id_datos_ieo_profesional_estudiantes', 'anio', 'estado', 'estudiantes_participantes', 'apps_desarrolladas', 'numero_pruebas', 'numero_disecciones', 'id_datos_sesion'], 'integer'],
            [['nombre_aplicaciones', 'tipo_accion', 'descripcion', 'responsable_accion', 'tiempo_desarrollo', 'tic', 'tipo_uso_tic', 'digitales', 'tipo_uso_digitales', 'no_tic', 'tipo_uso_no_tic', 'tiempo_uso_tic', 'numero_obras', 'tipo_obras', 'indice_temas', 'observaciones','estudiantes_id'], 'string'],
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
            // 'id_ciclo' => 'Id Ciclo',
            'anio' => 'Año',
            'estado' => 'Estado',
            'estudiantes_participantes' => 'Estudiantes Participantes',
            'apps_desarrolladas' => 'Apps Desarrolladas',
            'nombre_aplicaciones' => 'Nombre Aplicaciones',
            'tipo_accion' => 'Tipo Accion',
            'descripcion' => 'Descripcion',
            'responsable_accion' => 'Responsable Accion',
            'tiempo_desarrollo' => 'Tiempo Desarrollo',
            'tic' => 'Tic',
            'tipo_uso_tic' => 'Tipo Uso Tic',
            'digitales' => 'Digitales',
            'tipo_uso_digitales' => 'Tipo Uso Digitales',
            'no_tic' => 'No Tic',
            'tipo_uso_no_tic' => 'Tipo Uso No Tic',
            'tiempo_uso_tic' => 'Tiempo Uso Tic',
            'numero_obras' => 'Numero Obras',
            'tipo_obras' => 'Tipo Obras',
            'indice_temas' => 'Indice Temas',
            'numero_pruebas' => 'Numero Pruebas',
            'numero_disecciones' => 'Numero Disecciones',
            'observaciones' => 'Observaciones',
            'id_datos_sesion' => 'Id Datos Sesion',
            'estudiantes_id' => 'Estudiantes',
        ];
    }
}
