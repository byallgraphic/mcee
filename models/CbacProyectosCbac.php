<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.proyectos_cbac".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 */
class CbacProyectosCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.proyectos_cbac';
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
