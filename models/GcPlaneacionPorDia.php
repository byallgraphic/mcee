<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.planeacion_por_dia".
 *
 * @property string $id
 * @property string $id_momento1_planeacion
 * @property string $id_dia
 * @property string $descripcion_plan
 */
class GcPlaneacionPorDia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.planeacion_por_dia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_momento1_planeacion', 'id_dia','descripcion_plan'], 'required'],
            [['id_momento1_planeacion', 'id_dia'], 'default', 'value' => null],
            [['id_momento1_planeacion', 'id_dia'], 'integer'],
            [['descripcion_plan'], 'string', 'max' => 10000],
            [['id_dia'], 'exist', 'skipOnError' => true, 'targetClass' => GcDiasPlaneacion::className(), 'targetAttribute' => ['id_dia' => 'id']],
            [['id_momento1_planeacion'], 'exist', 'skipOnError' => true, 'targetClass' => GcMomento1::className(), 'targetAttribute' => ['id_momento1_planeacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_momento1_planeacion' => 'Id Momento1 Planeacion',
            'id_dia' => 'Día',
            'descripcion_plan' => 'Descripción Plan',
        ];
    }
}
