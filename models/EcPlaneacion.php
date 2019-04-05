<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.planeacion".
 *
 * @property int $id
 * @property int $id_datos_basicos
 * @property string $tipo_actividad
 * @property string $fecha
 * @property string $objetivo
 * @property string $responsable
 * @property string $rol
 * @property string $descripcion_actividad
 * @property int $estado
 * @property int $estudiantes
 * @property int $familias
 * @property int $docentes
 * @property int $directivos
 * @property int $otros
 */
class EcPlaneacion extends \yii\db\ActiveRecord
{

    public $tipo_actor;
    public $cantidad_asistentes;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.planeacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_basicos', 'tipo_actividad', 'fecha'], 'required'],
            [['id_datos_basicos', 'estado', 'estudiantes', 'familias', 'docentes', 'directivos', 'otros'], 'default', 'value' => null],
            [['id_datos_basicos', 'estado', 'estudiantes', 'familias', 'docentes', 'directivos', 'otros'], 'integer'],
            
            [['id_datos_basicos', 'estado', 'estudiantes', 'familias', 'docentes', 'directivos', 'otros', 'tipo_actividad', 'objetivo', 'responsable', 'rol', 'descripcion_actividad'], 'required'],
            [['tipo_actividad', 'objetivo', 'responsable', 'rol', 'descripcion_actividad'], 'string'],
            [['fecha'], 'safe'],
            [['id_datos_basicos'], 'exist', 'skipOnError' => true, 'targetClass' => EcDatosBasicos::className(), 'targetAttribute' => ['id_datos_basicos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_datos_basicos' => 'Id Datos Basicos',
            'tipo_actividad' => 'Tipo actividad',
            'fecha' => 'Fecha',
            'objetivo' => 'Objetivo',
            'responsable' => 'Responsable',
            'rol' => 'Rol',
            'descripcion_actividad' => 'Descripcipón actividad',
            'estado' => 'Estado',
            'estudiantes' => 'Estudiantes',
            'familias' => 'Familias',
            'docentes' => 'Docentes',
            'directivos' => 'Directivos',
            'otros' => 'Otros',
        ];
    }
}
