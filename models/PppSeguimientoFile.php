<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ppp.seguimiento_file}}".
 *
 * @property int $id
 * @property int $id_seguimiento_gestion
 * @property int $id_seguimiento_frente
 * @property string $file
 * @property int $id_reporte_actividades
 */
class PppSeguimientoFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ppp.seguimiento_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'id_seguimiento_gestion', 'id_seguimiento_frente', 'id_reporte_actividades'], 'default', 'value' => null],
            [['id', 'id_seguimiento_gestion', 'id_seguimiento_frente', 'id_reporte_actividades'], 'integer'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_seguimiento_gestion' => 'Id Seguimiento Gestion',
            'id_seguimiento_frente' => 'Id Seguimiento Frente',
            'file' => 'File',
            'id_reporte_actividades' => 'Id Reporte Actividades',
        ];
    }
}
