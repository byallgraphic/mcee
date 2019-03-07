<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.actividades_generales".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_procesos_generales
 * @property string $estado
 */
class EcActividadesGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.actividades_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_procesos_generales'], 'required'],
            [['descripcion'], 'string'],
            [['id_procesos_generales', 'estado'], 'default', 'value' => null],
            [['id_procesos_generales', 'estado'], 'integer'],
            [['id_procesos_generales'], 'exist', 'skipOnError' => true, 'targetClass' => EcProcesosGenerales::className(), 'targetAttribute' => ['id_procesos_generales' => 'id']],
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
            'id_procesos_generales' => 'Id Procesos Generales',
            'estado' => 'Estado',
        ];
    }
}
