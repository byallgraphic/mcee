<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.estado_actual_misional".
 *
 * @property string $id
 * @property string $id_consolidado_misional
 * @property string $id_actividades_consolidado
 * @property string $estado_actual
 * @property int $estado
 */
class CbacEstadoActualMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.estado_actual_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consolidado_misional', 'id_actividades_consolidado', 'estado'], 'default', 'value' => null],
            [['id_consolidado_misional', 'id_actividades_consolidado', 'estado'], 'integer'],
            [['estado_actual'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesConsolidadoMisional::className(), 'targetAttribute' => ['id' => 'id']],
            [['id_consolidado_misional'], 'exist', 'skipOnError' => true, 'targetClass' => CbacConsolidadoMisional::className(), 'targetAttribute' => ['id_consolidado_misional' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_consolidado_misional' => 'Id Consolidado Misional',
            'id_actividades_consolidado' => 'Id Actividades Consolidado',
            'estado_actual' => 'Estado Actual',
            'estado' => 'Estado',
        ];
    }
}
