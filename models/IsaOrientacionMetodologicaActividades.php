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
            [['id', 'descripcion', 'id_actividades', 'estado', 'id_seguimiento_proceso'], 'required'],
            [['id', 'id_actividades', 'estado', 'id_seguimiento_proceso'], 'default', 'value' => null],
            [['id', 'id_actividades', 'estado', 'id_seguimiento_proceso','id_logros'], 'integer'],
            [['descripcion'], 'string'],
            [['id'], 'unique'],
            [['id_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => IsaActividadesSeguimiento::className(), 'targetAttribute' => ['id_actividades' => 'id']],
            [['id_seguimiento_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => IsaSeguimientoProceso::className(), 'targetAttribute' => ['id_seguimiento_proceso' => 'id']],
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
            'id_logros' => 'Logros',
        ];
    }
}
