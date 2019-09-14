<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.procesos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proyecto
 * @property bool $estado
 * @property double $porcentaje_avance
 */
class EcProcesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.procesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['id_proyecto'], 'default', 'value' => null],
            [['id_proyecto'], 'integer'],
            [['estado'], 'boolean'],
            [['porcentaje_avance'], 'number'],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
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
            'porcentaje_avance' => 'Porcentaje Avance',
        ];
    }
}
