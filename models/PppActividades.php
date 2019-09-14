<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ppp.actividades".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 * @property string $id_objetivo
 */
class PppActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppp.actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['estado', 'id_objetivo'], 'required'],
            [['estado', 'id_objetivo'], 'default', 'value' => null],
            [['estado', 'id_objetivo'], 'integer'],
            [['id_objetivo'], 'exist', 'skipOnError' => true, 'targetClass' => PppObjetivos::className(), 'targetAttribute' => ['id_objetivo' => 'id']],
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
            'id_objetivo' => 'Id Objetivo',
        ];
    }
}
