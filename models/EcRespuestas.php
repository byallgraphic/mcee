<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.respuestas".
 *
 * @property string $id
 * @property string $respuesta
 * @property string $id_estrategia
 * @property bool $estado
 */
class EcRespuestas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.respuestas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['respuesta'], 'string'],
            [['respuesta'], 'required'],
            [['id_estrategia'], 'default', 'value' => null],
            [['id_estrategia'], 'integer'],
            [['estado'], 'boolean'],
            [['id_estrategia'], 'exist', 'skipOnError' => true, 'targetClass' => EcEstrategias::className(), 'targetAttribute' => ['id_estrategia' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'respuesta' => 'Respuesta',
            'id_estrategia' => 'Id Estrategia',
            'estado' => 'Estado',
        ];
    }
}
