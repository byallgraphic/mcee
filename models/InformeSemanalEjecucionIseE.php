<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_semanal_ejecucion_ise".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $sede_id
 * @property int $proyecto_id
 * @property int $estado
 */
class InformeSemanalEjecucionIseE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_semanal_ejecucion_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institucion_id', 'sede_id', 'proyecto_id', 'estado'], 'default', 'value' => null],
            [[ 'sede_id', 'proyecto_id', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institucion_id' => 'Institución',
            'sede_id' => 'Sede',
            'proyecto_id' => 'Proyecto',
            'estado' => 'Estado',
        ];
    }
}
