<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.orientacion_metodologica_actividades".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_actividades
 * @property string $estado
 * @property string $id_seguimiento_proceso
 * @property string $id_logros
 */
class IsaOrientacionMetodologicaActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.orientacion_metodologica_actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_actividades', 'estado', 'id_seguimiento_proceso'], 'required'],
            [['id_actividades', 'estado', 'id_seguimiento_proceso', 'id_logros'], 'default', 'value' => null],
            [['id_actividades', 'estado', 'id_seguimiento_proceso', 'id_logros'], 'integer'],
            [['id_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => IsaRomActividades::className(), 'targetAttribute' => ['id_actividades' => 'id']],
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
            'id_actividades' => 'Id Actividades',
            'estado' => 'Estado',
            'id_seguimiento_proceso' => 'Id Seguimiento Proceso',
            'id_logros' => 'Id Logros',
        ];
    }
}
