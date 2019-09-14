<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.productos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $anio
 * @property string $id_proyecto
 * @property bool $estado
 */
class EcProductos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'anio'], 'string'],
            [['id_proyecto'], 'default', 'value' => null],
            [['id_proyecto'], 'integer'],
            [['estado'], 'boolean'],
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
            'anio' => 'Anio',
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
        ];
    }
}
