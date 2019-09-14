<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.acciones".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proceso
 * @property string $estado
 */
class IsaAcciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_proceso', 'estado'], 'default', 'value' => null],
            [['id_proceso', 'estado'], 'integer'],
            [['id_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => IsaProcesos::className(), 'targetAttribute' => ['id_proceso' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'id_proceso' => 'Id Proceso',
            'estado' => 'Estado',
        ];
    }
}
