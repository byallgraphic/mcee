<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.orientacion_proceso".
 *
 * @property string $id
 * @property string $orientacion_proceso
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $id_institucion
 * @property string $id_sede
 * @property int $estado
 */
class IsaOrientacionProceso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.orientacion_proceso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orientacion_proceso', 'fecha_desde', 'fecha_hasta', 'id_institucion', 'id_sede', 'estado'], 'required'],
            [['orientacion_proceso'], 'string'],
            [['fecha_desde', 'fecha_hasta'], 'safe'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
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
            'orientacion_proceso' => 'Orientación Proceso',
            'fecha_desde' => 'Fecha Desde',
            'fecha_hasta' => 'Fecha Hasta',
            'id_institucion' => 'Institución',
            'id_sede' => 'Sede',
            'estado' => 'Estado',
        ];
    }
}
