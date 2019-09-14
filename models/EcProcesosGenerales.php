<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.procesos_generales".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proyectos_generales
 * @property string $estado
 */
class EcProcesosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.procesos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_proyectos_generales'], 'required'],
            [['descripcion'], 'string'],
            [['id_proyectos_generales', 'estado'], 'default', 'value' => null],
            [['id_proyectos_generales', 'estado'], 'integer'],
            [['id_proyectos_generales'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectosGenerales::className(), 'targetAttribute' => ['id_proyectos_generales' => 'id']],
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
