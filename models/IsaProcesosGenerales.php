<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.procesos_generales".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proyectos_generales
 * @property string $estado
 */
class IsaProcesosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.procesos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'descripcion', 'id_proyectos_generales', 'estado'], 'required'],
            [['id', 'id_proyectos_generales', 'estado'], 'default', 'value' => null],
            [['id', 'id_proyectos_generales', 'estado'], 'integer'],
            [['descripcion'], 'string'],
            [['id'], 'unique'],
            [['id_proyectos_generales'], 'exist', 'skipOnError' => true, 'targetClass' => IsaProyectosGenerales::className(), 'targetAttribute' => ['id_proyectos_generales' => 'id']],
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
            'id_proyectos_generales' => 'Id Proyectos Generales',
            'estado' => 'Estado',
        ];
    }
}
