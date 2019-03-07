<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.proyectos_generales".
 *
 * @property string $id
 * @property string $descripcion
 * @property int $tipo_proyecto
 * @property string $estado
 */
class EcProyectosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.proyectos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'tipo_proyecto'], 'required'],
            [['descripcion'], 'string'],
            [['tipo_proyecto', 'estado'], 'default', 'value' => null],
            [['tipo_proyecto', 'estado'], 'integer'],
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
            'tipo_proyecto' => 'Tipo Proyecto',
            'estado' => 'Estado',
        ];
    }
}
