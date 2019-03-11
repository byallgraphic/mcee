<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.tipos_cantidad_poblacion".
 *
 * @property int $id
 * @property int $actividad_id
 * @property int $ieo_id
 * @property string $tiempo_libre
 * @property string $edu_derechos
 * @property string $sexualidad
 * @property string $ciudadania
 * @property string $medio_ambiente
 * @property string $familia
 * @property string $directivos
 * @property string $fecha_creacion
 * @property int $proyecto_ieo_id
 * @property string $tipo_actividad
 * @property string $docentes
 * @property string $psicoorientador
 */
class TiposCantidadPoblacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.tipos_cantidad_poblacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actividad_id', 'ieo_id'], 'default', 'value' => null],
            [['actividad_id', 'ieo_id'], 'integer'],
            [['tipo_actividad'], 'string'],
            [['tiempo_libre', 'edu_derechos', 'sexualidad', 'ciudadania', 'medio_ambiente', 'familia', 'directivos', 'docentes', 'psicoorientador'], 'string'],
            [['fecha_creacion'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actividad_id' => 'Actividad',
            'ieo_id' => 'IeoD',
            'tiempo_libre' => 'Tiempo libre',
            'edu_derechos' => 'Edu derechos',
            'sexualidad' => 'Sexualidad',
            'ciudadania' => 'Ciudadanía',
            'medio_ambiente' => 'Medio ambiente',
            'familia' => 'Familia',
            'directivos' => 'Directivos',
            'fecha_creacion' => 'Fecha Creación',
            'docentes' => 'Docentes',
            'psicoorientador' => 'Psicoorientador',
        ];
    }
}
