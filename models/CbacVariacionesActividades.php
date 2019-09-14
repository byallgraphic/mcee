<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.variaciones_actividades".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_actividades
 * @property string $estado
 */
class CbacVariacionesActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.variaciones_actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_actividades'], 'required'],
            [['descripcion'], 'string'],
            [['id_actividades', 'estado'], 'default', 'value' => null],
            [['id_actividades', 'estado'], 'integer'],
            [['id_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesSeguimiento::className(), 'targetAttribute' => ['id_actividades' => 'id']],
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
        ];
    }
}
