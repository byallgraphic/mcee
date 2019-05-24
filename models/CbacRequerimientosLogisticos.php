<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.requerimientos_logisticos".
 *
 * @property string $id
 * @property int $id_requerimiento
 * @property int $cantidad
 * @property string $id_plan_misional_operativo
 * @property string $id_actividad
 * @property string $estado
 */
class CbacRequerimientosLogisticos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.requerimientos_logisticos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_requerimiento', 'cantidad', 'id_plan_misional_operativo', 'id_actividad', 'estado'], 'default', 'value' => null],
            [['id_requerimiento', 'cantidad', 'id_plan_misional_operativo', 'id_actividad', 'estado'], 'integer'],
            [['id_plan_misional_operativo'], 'exist', 'skipOnError' => true, 'targetClass' => CbacPlanMisionalOperativo::className(), 'targetAttribute' => ['id_plan_misional_operativo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_requerimiento' => 'Id Requerimiento',
            'cantidad' => 'Cantidad',
            'id_plan_misional_operativo' => 'Id Plan Misional Operativo',
            'id_actividad' => 'Id Actividad',
            'estado' => 'Estado',
        ];
    }
}
