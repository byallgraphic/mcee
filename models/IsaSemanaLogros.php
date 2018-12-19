<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.semana_logros".
 *
 * @property string $id
 * @property string $semana1
 * @property string $semana2
 * @property string $semana3
 * @property string $semana4
 * @property string $id_logros_actividades
 * @property string $estado
 */
class IsaSemanaLogros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.semana_logros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['semana1', 'semana2', 'semana3', 'semana4'], 'string'],
            [['id_logros_actividades', 'estado'], 'default', 'value' => null],
            [['id_logros_actividades', 'estado'], 'integer'],
            [['id_logros_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => IsaLogrosActividades::className(), 'targetAttribute' => ['id_logros_actividades' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semana1' => 'Semana1',
            'semana2' => 'Semana2',
            'semana3' => 'Semana3',
            'semana4' => 'Semana4',
            'id_logros_actividades' => 'Id Logros Actividades',
            'estado' => 'Estado',
        ];
    }
}
