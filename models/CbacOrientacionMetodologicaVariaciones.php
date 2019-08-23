<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.orientacion_metodologica_variaciones".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_variaciones_actividades
 * @property string $estado
 * @property string $id_seguimiento_proceso
 */
class CbacOrientacionMetodologicaVariaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.orientacion_metodologica_variaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_variaciones_actividades', 'estado'], 'required'],
            [['id_variaciones_actividades', 'estado', 'id_seguimiento_proceso'], 'default', 'value' => null],
            [['id_variaciones_actividades', 'estado', 'id_seguimiento_proceso'], 'integer'],
            [['id_variaciones_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => CbacVariacionesActividades::className(), 'targetAttribute' => ['id_variaciones_actividades' => 'id']],
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
            'id_variaciones_actividades' => 'Id Variaciones Actividades',
            'estado' => 'Estado',
            'id_seguimiento_proceso' => 'Id Seguimiento Proceso',
        ];
    }
}
