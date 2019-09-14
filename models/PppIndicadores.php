<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ppp.indicadores".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 * @property string $id_seguidores
 */
class PppIndicadores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppp.indicadores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['estado', 'id_seguidores'], 'required'],
            [['estado', 'id_seguidores'], 'default', 'value' => null],
            [['estado', 'id_seguidores'], 'integer'],
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
            'id_seguidores' => 'Id Seguidores',
        ];
    }
}
