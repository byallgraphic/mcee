<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.estrategias".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_producto
 * @property bool $estado
 */
class EcEstrategias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.estrategias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_producto'], 'default', 'value' => null],
            [['id_producto'], 'integer'],
            [['estado'], 'boolean'],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProductos::className(), 'targetAttribute' => ['id_producto' => 'id']],
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
            'id_producto' => 'Id Producto',
            'estado' => 'Estado',
        ];
    }
}
