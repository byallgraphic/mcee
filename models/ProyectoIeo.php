<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_ieo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $estado
 *
 * @property Ieo[] $ieos
 */
class ProyectoIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.proyecto_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIeos()
    {
        return $this->hasMany(Ieo::className(), ['proyecto_id' => 'id']);
    }
}
