<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.proyectos_generales".
 *
 * @property string $id
 * @property string $descripcion
 * @property int $tipo_proyecto
 * @property string $estado
 */
class CbacProyectosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.proyectos_generales';
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
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
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
