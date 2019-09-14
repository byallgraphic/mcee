<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.acciones".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proceso
 * @property string $estado
 */
class CbacAcciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.acciones';
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
            [['id_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => CbacProcesos::className(), 'targetAttribute' => ['id_proceso' => 'id']],
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
