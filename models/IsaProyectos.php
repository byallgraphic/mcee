<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.proyectos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $horario
 * @property string $estado
 */
class IsaProyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'horario'], 'string'],
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
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
            'horario' => 'Horario',
            'estado' => 'Estado',
        ];
    }
}
