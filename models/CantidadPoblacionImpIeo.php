<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.cantidad_poblacion_imp_ieo".
 *
 * @property int $id
 * @property int $implementacion_ieo_id
 * @property string $tiempo_libre
 * @property string $edu_derechos
 * @property string $sexualidad
 * @property string $ciudadania
 * @property string $medio_ambiente
 * @property string $familia
 * @property string $directivos
 * @property string $fecha_creacion
 * @property int $tipo_actividad
 * @property int $id_actividad
 */
class CantidadPoblacionImpIeo extends \yii\db\ActiveRecord
{
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.cantidad_poblacion_imp_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['implementacion_ieo_id', 'tipo_actividad', 'id_actividad'], 'default', 'value' => null],
            [['implementacion_ieo_id', 'tipo_actividad', 'id_actividad'], 'integer'],
            [['tiempo_libre', 'edu_derechos', 'sexualidad', 'ciudadania', 'medio_ambiente', 'familia', 'directivos'], 'string'],
            [['tiempo_libre', 'edu_derechos', 'sexualidad', 'ciudadania', 'medio_ambiente', 'familia', 'directivos'], 'required'],
            [['fecha_creacion'], 'safe'],
            [['tipo_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => ActividadesIeo::className(), 'targetAttribute' => ['tipo_actividad' => 'id']],
            [['implementacion_ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImplementacionIeo::className(), 'targetAttribute' => ['implementacion_ieo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'implementacion_ieo_id' => 'Implementacion Ieo ID',
            'tiempo_libre' => 'Tiempo Libre',
            'edu_derechos' => 'Edu Derechos',
            'sexualidad' => 'Sexualidad',
            'ciudadania' => 'Ciudadanía',
            'medio_ambiente' => 'Medio Ambiente',
            'familia' => 'Familia',
            'directivos' => 'Directivos',
            'fecha_creacion' => 'Fecha Creación',
            'tipo_actividad' => 'Tipo Actividad',
            'id_actividad' => 'Id Actividad',
        ];
    }
}
