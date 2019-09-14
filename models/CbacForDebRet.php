<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.for_deb_ret".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_variaciones_actividades
 * @property string $estado
 */
class CbacForDebRet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.for_deb_ret';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_variaciones_actividades'], 'required'],
            [['descripcion'], 'string'],
            [['id_variaciones_actividades', 'estado'], 'default', 'value' => null],
            [['id_variaciones_actividades', 'estado'], 'integer'],
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
        ];
    }
}
