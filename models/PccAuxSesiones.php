<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Aux_sesiones".
 *
 * @property string $Sesion
 * @property string $Pregunta_interdiciplinaria
 */
class PccAuxSesiones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Aux_sesiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sesion', 'Pregunta_interdiciplinaria'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Sesion' => 'Sesion',
            'Pregunta_interdiciplinaria' => 'Pregunta Interdiciplinaria',
        ];
    }
}
