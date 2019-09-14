<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.procesos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proyecto
 * @property string $estado
 */
class CbacProcesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.procesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_proyecto', 'estado'], 'default', 'value' => null],
            [['id_proyecto', 'estado'], 'integer'],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => CbacProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
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
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
        ];
    }
}
