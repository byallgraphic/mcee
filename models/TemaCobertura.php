<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tema_cobertura".
 *
 * @property int $id
 * @property string $nombre
 * @property int $estado
 * @property int $sub_categorias_cobertura_id
 *
 * @property Cobertura[] $coberturas
 * @property Estados $estado0
 * @property SubCategoriasCobertura $subCategoriasCobertura
 */
class TemaCobertura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tema_cobertura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string'],
            [['estado', 'sub_categorias_cobertura_id'], 'default', 'value' => null],
            [['estado', 'sub_categorias_cobertura_id'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['sub_categorias_cobertura_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriasCobertura::className(), 'targetAttribute' => ['sub_categorias_cobertura_id' => 'id']],
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
            'sub_categorias_cobertura_id' => 'Sub Categorias Cobertura ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoberturas()
    {
        return $this->hasMany(Cobertura::className(), ['tema_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriasCobertura()
    {
        return $this->hasOne(SubCategoriasCobertura::className(), ['id' => 'sub_categorias_cobertura_id']);
    }
}
