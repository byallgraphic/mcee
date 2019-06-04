<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tipo_perfil}}".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 *
 * @property PazCultura[] $pazCulturas
 */
class TipoPerfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tipo_perfil}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 200],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPazCulturas()
    {
        return $this->hasMany(PazCultura::className(), ['tipo_perfil' => 'id']);
    }
}
