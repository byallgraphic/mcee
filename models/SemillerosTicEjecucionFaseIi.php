<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ejecucion_fase_ii".
 *
 * @property string $id
 * @property string $id_datos_ieo_profesional
 * @property string $docentes
 * @property string $asignaturas
 * @property string $especialidad
 * @property string $numero_apps_desarrolladas
 * @property string $nombre_aplicaciones_desarrolladas
 * @property string $nombre_aplicaciones_creadas
 * @property string $numero
 * @property string $tipo_obra
 * @property string $temas_abordados
 * @property string $numero_pruebas
 * @property string $numero_disecciones
 * @property string $observaciones_generales
 * @property string $id_fase
 * @property string $estado
 */
class SemillerosTicEjecucionFaseIi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ejecucion_fase_ii';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_ieo_profesional','id_fase','estado','id_datos_sesiones'], 'required'],
            [['id_datos_ieo_profesional', 'id_fase', 'estado'], 'default', 'value' => null],
            [['id_datos_ieo_profesional', 'id_fase', 'estado'], 'integer'],
            [['docentes', 'asignaturas', 'especialidad', 'numero_apps_desarrolladas', 'nombre_aplicaciones_desarrolladas', 'nombre_aplicaciones_creadas', 'numero', 'tipo_obra', 'temas_abordados', 'numero_pruebas', 'numero_disecciones', 'observaciones_generales'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_datos_ieo_profesional'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosIeoProfesional::className(), 'targetAttribute' => ['id_datos_ieo_profesional' => 'id']],
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
            'id_datos_ieo_profesional' => 'Id Datos Ieo Profesional',
            'docentes' => 'Docentes',
            'asignaturas' => 'Asignaturas',
            'especialidad' => 'Especialidad',
            'numero_apps_desarrolladas' => 'Numero Apps Desarrolladas',
            'nombre_aplicaciones_desarrolladas' => 'Nombre Aplicaciones Desarrolladas',
            'nombre_aplicaciones_creadas' => 'Nombre Aplicaciones Creadas',
            'numero' => 'Numero',
            'tipo_obra' => 'Tipo Obra',
            'temas_abordados' => 'Temas Abordados',
            'numero_pruebas' => 'Numero Pruebas',
            'numero_disecciones' => 'Numero Disecciones',
            'observaciones_generales' => 'Observaciones Generales',
            'id_fase' => 'Id Fase',
            'estado' => 'Estado',
            'id_datos_sesiones' => 'Datos Sesiones',
        ];
    }
}