<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.seguimiento_proceso".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $estado
 * @property string $fecha
 */
class IsaSeguimientoProceso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.seguimiento_proceso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado', 'fecha'], 'required'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha'], 'string', 'max' => 7],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_institucion' => 'Institución',
            'id_sede' => 'Sede',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
        ];
    }
}
