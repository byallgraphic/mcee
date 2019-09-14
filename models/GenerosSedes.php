<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generos_sedes".
 *
 * @property string $id
 * @property string $descripcion
 *
 * @property Sedes[] $sedes
 */
class GenerosSedes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generos_sedes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 60],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedes()
    {
        return $this->hasMany(Sedes::className(), ['id_generos_sedes' => 'id']);
    }
}
