<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_mensual_misional_logros".
 *
 * @property int $id
 * @property string $id_acciones
 * @property int $estado_actual
 * @property string $logro_descripcion
 */
class EcInformeMensualMisionalLogros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_mensual_misional_logros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_acciones', 'estado_actual', 'logro_descripcion'], 'required'],
            [['id_acciones', 'estado_actual'], 'default', 'value' => null],
            [['id_acciones', 'estado_actual'], 'integer'],
            [['logro_descripcion'], 'string'],
            [['id_acciones'], 'exist', 'skipOnError' => true, 'targetClass' => EcAcciones::className(), 'targetAttribute' => ['id_acciones' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_acciones' => 'Id Acciones',
            'estado_actual' => 'Estado Actual',
            'logro_descripcion' => 'Logro Descripcion',
        ];
    }
}
