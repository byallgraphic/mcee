<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.rom_proyectos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 */
class CbacRomProyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.rom_proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
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
            'estado' => 'Estado',
        ];
    }
}
