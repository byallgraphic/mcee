<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.requerimiento_extra_ieo".
 *
 * @property int $id
 * @property string $socializacion_ruta
 * @property string $soporte_necesidad
 * @property int $ieo_id
 * @property int $proyecto_ieo_id
 * @property int $actividad_id
 */
class RequerimientoExtraIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.requerimiento_extra_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['socializacion_ruta', 'soporte_necesidad'], 'string'],
            [['ieo_id', 'proyecto_ieo_id', 'actividad_id'], 'default', 'value' => null],
            [['ieo_id', 'proyecto_ieo_id', 'actividad_id'], 'integer'],
            [['ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ieo::className(), 'targetAttribute' => ['ieo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'socializacion_ruta' => 'Socializacion Ruta',
            'soporte_necesidad' => 'Soporte Necesidad',
            'ieo_id' => 'Ieo ID',
            'proyecto_ieo_id' => 'Proyecto Ieo ID',
            'actividad_id' => 'Actividad ID',
        ];
    }
}
