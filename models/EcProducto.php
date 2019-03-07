<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.producto".
 *
 * @property int $id
 * @property string $informe_ruta
 * @property string $plan_accion_ruta
 * @property string $presentacion_plan
 * @property string $id_ieo
 * @property string $estado
 */
class EcProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['informe_ruta', 'plan_accion_ruta', 'presentacion_plan', 'id_ieo'], 'required'],
            [['informe_ruta', 'plan_accion_ruta', 'presentacion_plan'], 'string'],
            [['id_ieo', 'estado'], 'default', 'value' => null],
            [['id_ieo', 'estado'], 'integer'],
            [['id_ieo'], 'exist', 'skipOnError' => true, 'targetClass' => Ieo::className(), 'targetAttribute' => ['id_ieo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'informe_ruta' => 'Informe Ruta',
            'plan_accion_ruta' => 'Plan Accion Ruta',
            'presentacion_plan' => 'Presentacion Plan',
            'id_ieo' => 'Id Ieo',
            'estado' => 'Estado',
        ];
    }
}
