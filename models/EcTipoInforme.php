<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.tipo_informe".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 * @property string $id_componente
 */
class EcTipoInforme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.tipo_informe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'estado'], 'required'],
            [['estado', 'id_componente'], 'default', 'value' => null],
            [['estado', 'id_componente'], 'integer'],
            [['descripcion'], 'string', 'max' => 600],
            [['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => EcComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
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
            'id_componente' => 'Id Componente',
        ];
    }
}
