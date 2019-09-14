<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.acciones".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proceso
 * @property bool $estado
 */
class EcAcciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_proceso'], 'default', 'value' => null],
            [['id_proceso'], 'integer'],
            [['estado'], 'boolean'],
            [['id_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => EcProcesos::className(), 'targetAttribute' => ['id_proceso' => 'id']],
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
