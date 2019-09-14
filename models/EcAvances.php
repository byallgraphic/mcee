<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avances".
 *
 * @property string $id
 * @property string $estado_actual
 * @property string $logros
 * @property string $retos
 * @property string $argumentos
 * @property string $id_acciones
 * @property bool $estado
 */
class EcAvances extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado_actual', 'retos', 'argumentos'], 'string','max' => 300],
            [['logros'], 'string','max' => 500],
            [['estado_actual', 'logros', 'retos', 'argumentos'], 'required'],
            [['id_acciones'], 'default', 'value' => null],
            [['id_acciones'], 'integer'],
            [['estado'], 'string'],
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
            'estado_actual' => 'Estado Actual',
            'logros' => 'Logros',
            'retos' => 'Retos',
            'argumentos' => 'Argumentos',
            'id_acciones' => 'Id Acciones',
            'estado' => 'Estado',
        ];
    }
}
